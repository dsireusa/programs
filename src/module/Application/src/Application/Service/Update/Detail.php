<?php

namespace Application\Service\Update;

use FzyCommon\Util\Params;

/**
 * Class Detail.
 */
class Detail extends Base
{
    const MAIN_TAG = 'detail';

    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\Program\Detail';

    const MAIN_ENTITY_ID_PARAM = 'detailId';

    /**
     * Called after all forms have been validated.
     * Passed the validation result.
     *
     * @param bool  $valid
     * @param Param $params
     */
    protected function postValidate($valid, Params $params, $options = array())
    {
        /* @var $program \Application\Entity\Base\Program */
        $detail = $this->entity();
        if ($valid) {
            // don't put a success message in session
            $this->setUseSessionMessage(false);
            //add the template to the detail
            $template = $this->em()->getRepository('Application\Entity\Base\Program\Detail\Template')->find($params->get('templateId'));
            $detail->setTemplate($template);
        }

        return parent::postValidate($this->valid, $params, $options);
    }
}
