<?php

namespace Application\Service\Search\Base\DQL;

use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;
use Doctrine\ORM\QueryBuilder;

class City extends DQL
{
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
        return 'cityId';
    }

    /**
     * Returns an identifying name for this type of search
     * (so pages with multiple paginated data sets can generate events
     * about this data set being updated/modified).
     *
     * @return string
     */
    public function getResultTag()
    {
        return 'cities';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Program\City';
    }

    /**
     * Alias for the primary repository in the DQL statement.
     *
     * @return string
     */
    public function getRepositoryAlias()
    {
        return 'c';
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
        $fuzzySearch = '%'.preg_replace('/\W/i', '', $search).'%';
        $qb->andWhere($this->alias('name').' LIKE :search')->setParameter('search', $fuzzySearch);

        return $this;
    }

    /**
     * Add where clauses to the query.
     *
     * @param Param        $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        $qb->addOrderBy($this->getRepositoryAlias().'.name');

        return parent::addFilters($params, $qb)->filterByState($params, $qb);
    }

    /**
     * filter to return all utilities for a given state.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByState(Params $params, QueryBuilder $qb)
    {
        if (is_numeric($params->get('state'))) {
            $params->set('stateId', $params->get('state'));
        }

        return $this->quickParamFilter($params, $qb, 'stateId', 'state');
    }
}
