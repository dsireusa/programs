<?php

/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller\Api;

class UserController extends AbstractApiController
{
    /**
     * @return mixed
     */
    protected function getSearchServiceKey()
    {
        return 'users';
    }

    /**
     * @return mixed
     */
    protected function getUpdateServiceKey()
    {
        return 'user';
    }

    public function resetPasswordAction()
    {
        $params = $this->getParamsFromRequest();
        /* @var $service \Application\Service\Update\User\Password */
        $service = $this->getServiceLocator()->get('user_password_reset');
        $service->setMainEntityFromParam($params, $this->getSearchService($params));

        return $this->update($params, $service);
    }
}
