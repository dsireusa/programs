<?php

namespace Application\Service\Search\Base\DQL;

use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;
use Doctrine\ORM\QueryBuilder;

class ZipCode extends DQL
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
        return 'zipcodeId';
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
        return 'zipcodes';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Utility\ZipCode';
    }

    /**
     * Alias for the primary repository in the DQL statement.
     *
     * @return string
     */
    public function getRepositoryAlias()
    {
        return 'z';
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
        $qb->andWhere($this->alias('zipcode').' LIKE :search')->setParameter('search', $fuzzySearch);

        return $this;
    }

    /**
     * Add where clauses to the query.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterById($params, $qb)->filterByState($params, $qb)->filterByCity($params, $qb)->filterByZipCode($params, $qb);
    }

    /**
     * filter to return all zip codes for a given state.
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

    /**
     * filter to return all zip codes for a given city.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByCity(Params $params, QueryBuilder $qb)
    {
        if (is_numeric($params->get('city'))) {
            return $this->quickParamFilter($params, $qb, 'city');
        }

        return $this;
    }
    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     */
    protected function filterByZipCode(Params $params, QueryBuilder $qb)
    {
        if ($params->has('zipcode')) {
            $qb->andWhere($this->alias('zipcode').' = :zipcode')->setParameter('zipcode', $params->get('zipcode'));
        }

        return $this;
    }
    protected function filterById(Params $params, QueryBuilder $qb)
    {
        if ($params->has('id')) {
            $qb->andWhere($this->alias('id').' = :id')->setParameter('id', $params->get('id'));
        }

        return $this;
    }
}
