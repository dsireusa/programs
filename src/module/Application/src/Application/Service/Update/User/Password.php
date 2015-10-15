<?php

namespace Application\Service\Update\User;

use Application\Entity\Base\UserInterface;
use Application\Service\Update\User as UpdateService;
use FzyCommon\Util\Params;

class Password extends UpdateService
{
    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\User';

    const MAIN_ENTITY_ID_PARAM = 'userId';

    const MAIN_TAG = 'user';

    public function update(Params $params, $options = array())
    {
        $this->valid = true;
        $this->sendPasswordReset($this->entity(), Params::create(array(
            'reset_subject' => 'Reset Your Account Password',
            'view' => 'emails/admin-reset',
        )));

        return $this;
    }

    protected function onFailedPasswordReset(\Exception $exception, \FzyAuth\Service\Password\Forgot $service, UserInterface $user, Params $params, Params $options = null)
    {
        $this->valid = false;
        $this->setErrorMessages(array('x' => $exception->getMessage()));
    }
}
