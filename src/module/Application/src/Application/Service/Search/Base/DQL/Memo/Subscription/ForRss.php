<?php

namespace Application\Service\Search\Base\DQL\Memo\Subscription;

use Application\Service\Search\Base\DQL\Memo\Subscription;
use Doctrine\ORM\QueryBuilder;
use FzyCommon\Util\Params;

/**
 * Class ByState.
 */
class ForRss extends Subscription
{
    public function getLimit()
    {
        return 25;
    }

    protected function addOrdering(Params $params, QueryBuilder $qb)
    {
        return $qb->addOrderBy($this->alias('dateAdded'), 'DESC');
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterByPrograms($params, $qb);
    }

    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        $object = parent::process($entity, $params, $results, $asEntity);
        if (!$asEntity) {
            $program = $entity->getProgram();
            $object['program'] = $program->getName();
            $object['state'] = $program->getState()->getName();
            $object['detail'] = $this->getServiceLocator()->get('FzyCommon\Service\Url')->fromRoute('home/system/program', array('action' => 'detail', 'programId' => $program->id()), array('force_canonical' => true));
            $object['subscribe'] = $this->getServiceLocator()->get('FzyCommon\Service\Url')->fromRoute('home/rss/get/action', array('action' => 'program', 'searchId' => $program->id()), array('force_canonical' => true));
        }

        return $object;
    }
}
