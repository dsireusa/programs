<?php

namespace Application\Service\Search\Base\DQL\Program\Published;

use Application\Service\Search\Base\DQL\Program\Published;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use FzyCommon\Util\Params;

/**
 * Class ByState.
 */
class ByState extends Published
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
            ->addSelect('partial s.{id, name, abbreviation}')
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
        $qb->leftJoin($this->alias('state'), 's');
        $qb->groupBy('s.id');

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
            'state' => array('name' => $entity['s_name'], 'abbreviation' => $entity['s_abbreviation']),
            'total' => $entity['total'],
            'url' => $this->url()->fromRoute('home/system/program', array(), array('query' => array('state' => $entity['s_abbreviation']), 'force_canonical' => true)),
        );
    }

    protected function addOrdering(Params $params, QueryBuilder $qb)
    {
        $qb->addOrderBy('s.name', 'ASC');

        return parent::addOrdering($params, $qb);
    }
}
