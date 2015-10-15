<?php

namespace Application\Service\Update;

use FzyCommon\Util\Params;

class Contact extends Base
{
    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\Contact';

    const MAIN_ENTITY_ID_PARAM = 'contactId';

    const MAIN_TAG = 'contact';

    /**
     * Returns the route name to redirect to on successful update.
     *
     * @return string
     */
    public function getSuccessRedirectRouteName()
    {
        return 'home/system/contact';
    }

    /**
     * @param bool   $valid
     * @param Params $params
     */
    protected function postValidate($valid, Params $params, $options = array())
    {
        /* @var $program \Application\Entity\Base\Contact */
        $contact = $this->entity();
        if ($valid) {
            //make sure phone number is only saved as digits
            if ($contact->getPhone()) {
                $contact->setPhone(preg_replace('/[^0-9+]/', '', $contact->getPhone()));
            }
        }

        return parent::postValidate($this->valid, $params, $options);
    }
}
