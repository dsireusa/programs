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

use Zend\View\Model\JsonModel;

class StateController extends AbstractApiController
{
    /**
     * @return mixed
     */
    protected function getSearchServiceKey()
    {
        return 'states';
    }

    /**
     * @return mixed
     */
    protected function getUpdateServiceKey()
    {
        throw new \RuntimeException('States may not be updated');
    }

    protected function territoriesAction()
    {
        $params = $this->getParamsFromRequest();

        return  new JsonModel($this->getServiceLocator()->get('territories')->search($params)->getResults());
    }
}
