<?php

namespace Application\Controller\Api;

use Zend\View\Model\JsonModel;

class UtilityController extends AbstractApiController
{
    /**
     * @return mixed
     */
    protected function getSearchServiceKey()
    {
        return 'utilities';
    }

    /**
     * @return mixed
     */
    protected function getUpdateServiceKey()
    {
        throw new \RuntimeException('Utilities may not be updated');
    }
    protected function hasprogramAction()
    {
        $params = $this->getParamsFromRequest();

        return new JsonModel($this->fzySearchResult($this->getServiceLocator()->get('utilities-has-program')->search($params)));
    }
}
