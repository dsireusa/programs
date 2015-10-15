<?php

namespace Application\Service\Update;

use Application\Entity\Base\UserInterface;
use FzyCommon\Util\Params;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class User extends Base
{
    const MAIN_ENTITY_CLASS = 'Application\Entity\Base\User';

    const MAIN_ENTITY_ID_PARAM = 'userId';

    const MAIN_TAG = 'user';

    protected function postValidate($valid, Params $params, $options = array())
    {
        parent::postValidate($valid, $params, $options);
        // user is saved at this point
        if ($valid) {
            // if the user has just been created, generate a password reset email.
            if ($this->getOperation() == static::OPERATION_CREATE) {
                $this->sendPasswordReset($this->entity(), Params::create(array(
                    'reset_subject' => 'Set Up Your Account Password',
                    'view' => 'emails/newuser',
                )));
            }
        }
    }

    protected function sendPasswordReset(UserInterface $user, Params $params, Params $options = null)
    {
        /* @var \FzyAuth\Service\Password\Forgot $passwordService */
        $passwordService = $this->getServiceLocator()->get('FzyAuth\Password\Forgot');
        try {
            //add stream writer as logger to log errors that occur when sending password resets
            $writer = new Stream('logs/email_admin_reset_passwords_log.txt');
            $logger = new Logger();
            $logger->addWriter($writer);
            $passwordService->setLogger($logger);
        } catch (\Exception $e) {
            //handle file exceptions for logger
        }
        try {
            $passwordService->handle($this->entity(), $options);
        } catch (\Exception $e) {
            // silence any SES failures
            $this->onFailedPasswordReset($e, $passwordService, $user, $params, $options);
        }

        return $this;
    }

    /**
     * Do nothing.
     *
     * @param \Exception                       $e
     * @param \FzyAuth\Service\Password\Forgot $service
     * @param UserInterface                    $user
     * @param Params                           $params
     * @param Params                           $options
     *
     * @return $this
     */
    protected function onFailedPasswordReset(\Exception $e, \FzyAuth\Service\Password\Forgot $service, UserInterface $user, Params $params, Params $options = null)
    {
        return $this;
    }

    /**
     * Returns the route name to redirect to on successful update.
     *
     * @return string
     */
    public function getSuccessRedirectRouteName()
    {
        return 'home/system/user';
    }
}
