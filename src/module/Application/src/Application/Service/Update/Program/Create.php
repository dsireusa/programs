<?php

namespace Application\Service\Update\Program;

use Application\Service\Update\Program as UpdateService;
use FzyCommon\Entity\BaseInterface;
use FzyCommon\Util\Params;
use Zend\EventManager\Event;
use Zend\Form\Form;

/**
 * Class Create.
 */
class Create extends UpdateService
{
    protected function preSetEntity(BaseInterface $entity)
    {
        /* @var $entity \Application\Entity\Base\Program */
        // set that the current user created this program
        $entity->setCreatedByUser($this->getCurrentUser());
        $entity->setCreatedTS('now');

        return parent::preSetEntity($entity);
    }

    protected function postValidate($valid, Params $params, $options = array())
    {
        /* @var $program \Application\Entity\Base\Program */
        $program = $this->entity();
        if ($valid) {
            if ($this->getOperation() == static::OPERATION_CREATE) {
                // create a program code
                $code = $this->generateProgramCode($program);
                $program->setCode($code);
            }
        }

        return parent::postValidate($valid, $params, $options);
    }

    /**
     * Set up event listeners for when a form is about to calculate the data to hydrate
     * (A hook for manipulating what data gets sent from the client before being validated).
     *
     * @return $this
     */
    protected function setUpFormDataEventListeners()
    {
        $this->formDataEvent(static::MAIN_TAG, function (Params $params) {
            $data = Params::create($params->slice(array('entireState')));
            $data->set('state', $params->getWrapped('state')->get('id'))
                ->set('category', $params->getWrapped('category')->get('id'))
                ->set('type', $params->getWrapped('type')->get('id'))
                ->set('implementingSector', $params->getWrapped('implementingSector')->get('id'));

            return $data;
        });

        return parent::setUpFormDataEventListeners();
    }

    public function getCreateSuccessMessage()
    {
        return 'New program has been created.';
    }

    public function getSuccessRedirectRouteParams()
    {
        return array('action' => 'edit', 'programId' => $this->getEntity()->id());
    }
}
