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

use Application\Service\Search\Base\DQL\Memo;
use FzyCommon\Util\Params;
use Zend\View\Model\JsonModel;

class MemoController extends AbstractApiController
{
    protected function getSearchService(Params $params)
    {
        $sm = $this->getServiceLocator();
        $key = $this->getSearchServiceKey().$params->get('memoType');
        if (!$sm->has($key)) {
            throw new \RuntimeException('Unable to locate memos of this type at this time.', 403);
        }
        /* @var $searchService \Application\Service\Search\Base\DQL\Memo\Program */
        $searchService = $sm->get($key);

        /* @var $auth \FzyAuth\Service\AclEnforcerInterface */
        $auth = $sm->get('FzyAuth\AclEnforcerFactory');
        if ($auth->isAllowed(Memo::RESOURCE_NAME, $searchService::PRIVILEGE)) {
            return $searchService;
        }
        // you are not permitted to view these types of memos
        throw new \RuntimeException('Unable to locate memos of this type at this time', 403);
    }

    protected function getUpdateService(Params $params)
    {
        $updateService = parent::getUpdateService($params);
        $sm = $this->getServiceLocator();
        /* @var $auth \FzyAuth\Service\AclEnforcerInterface */
        $auth = $sm->get('FzyAuth\AclEnforcerFactory');
        if ($auth->isAllowed($updateService::RESOURCE_NAME, $params->get('memoType'))) {
            return $updateService;
        }
        throw new \RuntimeException('Unable to update memos of this type.', 403);
    }

    /**
     * @return mixed
     */
    protected function getSearchServiceKey()
    {
        return 'memos_';
    }

    /**
     * @return mixed
     */
    protected function getUpdateServiceKey()
    {
        return 'memo';
    }

    public function deleteAction()
    {
        $params = $this->getParamsFromRequest();
        $em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $service = $this->getUpdateService($params);
        $em->remove($service->entity());
        $em->flush();

        return new JsonModel(array('success' => true));
    }
}
