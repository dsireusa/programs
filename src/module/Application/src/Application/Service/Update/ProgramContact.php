<?php

namespace Application\Service\Update;

use FzyCommon\Util\Params;

/**
 * Class ProgramContact.
 */
class ProgramContact extends Base
{
    const MAIN_TAG = 'program_contact';

    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\Program\Contact';

    const MAIN_ENTITY_ID_PARAM = 'programContactId';

    protected function postValidate($valid, Params $params, $options = array())
    {
        if ($valid) {
            /* @var $programContact \Application\Entity\Base\Program\Contact */
            $programContact = $this->entity();
            // look up the contact by id
            $contact = $this->em()->getRepository('Application\Entity\Base\Contact')->find($params->getWrapped('contact')->get('id'));
            if (!$contact) {
                $this->valid = $valid = false;
                $this->setErrorMessages(array('contact' => 'The provided contact is invalid.'));
            } else {
                $programContact->setContact($contact);
            }
        }

        return parent::postValidate($valid, $params, $options);
    }
}
