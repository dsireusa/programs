<?php

namespace Application\Service\Search\Base\DQL\Program\Published;

use Application\Service\Search\Base\DQL\Program\Published;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use FzyCommon\Util\Params;

/**
 * Class ByType.
 */
class ByType extends Published
{
    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addSelect(Params $params, QueryBuilder $qb)
    {
        $qb->select('partial '.$this->getRepositoryAlias().'.{id}')
            ->addSelect('partial t.{id, name}')
            ->addSelect('COUNT('.$this->getRepositoryAlias().') total');

        return $this;
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addFrom(Params $params, QueryBuilder $qb)
    {
        parent::addFrom($params, $qb);
        $qb->leftJoin($this->alias('type'), 't');
        $qb->groupBy('t.id');

        return $this;
    }

    protected function queryHook(Params $params, QueryBuilder $qb)
    {
        $query = $qb->getQuery();
        $query->setHydrationMode(Query::HYDRATE_SCALAR);

        return $query;
    }

    protected function getQBResult(Params $params, Query $query)
    {
        $result = $query->getScalarResult();
        $this->setTotal(count($result));

        return $result;
    }

    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        return array(
            'type' => array('id' => $entity['t_id'], 'name' => $entity['t_name']),
            'total' => $entity['total'],
            'url' => $this->url()->fromRoute('home/system/program', array(), array('query' => array('type' => $entity['t_id']), 'force_canonical' => true)),
        );
    }

    protected function addOrdering(Params $params, QueryBuilder $qb)
    {
        $qb->addOrderBy('t.name', 'ASC');

        return parent::addOrdering($params, $qb);
    }
}
