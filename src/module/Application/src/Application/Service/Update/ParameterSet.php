<?php

namespace Application\Service\Update;

use Application\Entity\Base\Parameter;
use FzyCommon\Util\Params;
use Zend\Form\Form;

/**
 * Class ParameterSet.
 */
class ParameterSet extends Base
{
    const MAIN_TAG = 'parameter_set';

    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\Parameter\Set';

    const MAIN_ENTITY_ID_PARAM = 'parameterSetId';

    protected function setUpFormDataEventListeners()
    {
        $this->formDataEvent(static::MAIN_TAG, array($this, 'handleParameterSetFormData'));
    }

    protected function beforeFormGeneration(array $entities)
    {
        /* @var $entity \Application\Entity\Base\Parameter\Set */
        $entity = $entities[static::MAIN_TAG];
        $entity->setFormTag($entity->getFormTag()."'+(".'$index || 0'.")+'");

        return parent::beforeFormGeneration($entities);
    }

    protected function generateFormValidators()
    {
        return array_merge(array(
            static::MAIN_TAG => array($this, 'validateSet'),
        ), parent::generateFormValidators());
    }

    protected function validateSet(Params $params, Form $form)
    {
        // attach technologies
        /* @var $set \Application\Entity\Base\Parameter\Set */
        $set = $this->entity();
        $set->clearTechnologies();
        $techIds = array_filter(array_map(function ($input) {return $input['id'];}, $params->get('technologies')));
        if (!empty($techIds)) {
            $technologies = $this->em()->createQuery("SELECT t FROM Application\Entity\Base\Technology t WHERE t.id IN (:ids)")->setParameter('ids',
                $techIds)->getResult();
            foreach ($technologies as $technology) {
                $set->addTechnology($technology);
            }
        }

//        if ($set->countTechnologies() < 1) {
//            var_dump($params->get());
//            var_dump($params->get('technologies'));
//            exit('no tech');
//        }
        // attach sectors
        $set->clearSectors();
        $sectorIds = array_filter(array_map(function ($input) {return $input['id'];}, $params->get('sectors')));
        if (!empty($sectorIds)) {
            $sectors = $this->em()->createQuery('SELECT s FROM Application\Entity\Base\Program\Sector s WHERE s.id IN (:ids)')->setParameter('ids',
                $sectorIds)->getResult();
            foreach ($sectors as $sector) {
                $set->addSector($sector);
            }
        }
//        if ($set->countSectors() < 1) {
//            var_dump($params->get());
//            var_dump($params->get('sectors'));
//            exit('no sectors');
//        }
        // attach parameters
        $set->clearParameters();
        foreach ($params->get('parameters') as $paramData) {
            $parameter = new Parameter();
            $this->em()->persist($parameter);
            $parameter->setParameterSet($set)
                ->setAmount($paramData['amount'])
                ->setQualifier($paramData['qualifier'])
                ->setSource($paramData['source'])
                ->setUnits($paramData['units']);
        }

        return true;
    }
}
