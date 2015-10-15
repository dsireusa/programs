<?php

namespace Application\Controller;

use FzyAuth\Controller\PasswordController as AuthController;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

class PasswordController extends AuthController
{
    public function forgotAction()
    {
        /* @var $forgotService \FzyAuth\Service\Password\Forgot */
        $forgotService = $this->getServiceLocator()->get('FzyAuth\Password\Forgot');
        try {
            //add stream writer as logger to log errors that occur when sending password resets
            $writer = new Stream('logs/email_user_reset_password_log.txt');
            $logger = new Logger();
            $logger->addWriter($writer);
            $forgotService->setLogger($logger);
        } catch (\Exception $e) {
            //handle file exceptions for logger
        }

        return parent::forgotAction();
    }
}
