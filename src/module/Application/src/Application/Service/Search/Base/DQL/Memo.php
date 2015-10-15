<?php

namespace Application\Service\Search\Base\DQL;

use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;
use Doctrine\ORM\QueryBuilder;

abstract class Memo extends DQL
{
    const RESOURCE_NAME = 'Application\Service\Search\Base\DQL\Memo';

    /**
     * This function should return the value of
     * the param name used to identify this search class' repository.
     *
     * Eg: if this is a User subclass, $this->getIdParam() ought to return 'userId'
     * so the param array can check if 'userId' was set and therefore
     * indicate a lookup rather than a general search
     *
     * @return mixed
     */
    protected function getIdParam()
    {
        return 'memoId';
    }

    /**
     * Alias for the primary repository in the DQL statement.
     *
     * @return string
     */
    public function getRepositoryAlias()
    {
        return 'm';
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->
        filterByProgram($params, $qb);
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByProgram(Params $params, QueryBuilder $qb)
    {
        return $this->quickParamFilter($params, $qb, 'programId', 'program');
    }

    protected function filterByPrograms(Params $params, QueryBuilder $qb)
    {
        if ($params->has('programIds')) {
            $this->addWhereInFilter($params, $qb, 'programIds', 'program');
        }

        return $this;
    }

    /**
     * This function is passed the datatables search query value
     * and should appropriately filter the query builder object
     * based on what makes sense for this entity.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     * @param $search
     *
     * @return $this
     */
    protected function searchFilter(Params $params, QueryBuilder $qb, $search)
    {
        return $this;
    }

    protected function addOrdering(Params $params, QueryBuilder $qb)
    {
        $qb->addOrderBy($this->alias('dateAdded'), 'DESC');

        return parent::addOrdering($params, $qb);
    }
}
