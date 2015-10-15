<?php

namespace Application\Service\Search\Base\DQL;

use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;
use Doctrine\ORM\QueryBuilder;

class Export extends DQL
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
        return 'exportId';
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
        return 'exports';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Export';
    }

    /**
     * Alias for the primary repository in the DQL statement.
     *
     * @return string
     */
    public function getRepositoryAlias()
    {
        return 'e';
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
        $qb->andWhere($this->alias('key').' LIKE :search')->setParameter('search', $fuzzySearch);

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
        return parent::addFilters($params, $qb)->filterByType($params, $qb);
    }

    /**
     * filter to return all utilities for a given state.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByType(Params $params, QueryBuilder $qb)
    {
        return $this->quickParamFilter($params, $qb, 'type');
    }

    protected function filterByMonth(Params $params, QueryBuilder $qb)
    {
        if ($params->get('month')) {
            try {
                $date = new \DateTime($params->get('month'));
                $start = clone $date;
                $start->modify('first day of this month');
                $start->setTime(0, 0, 0);
                $end = clone $date;
                $end->modify('last day of this month');
                $end->setTime(23, 59, 59);
                $qb->andWhere($this->alias('createdTs').' >= :start AND '.$this->alias('createdTs').' <= :end')
                ->setParameter('start', $start)
                ->setParameter('end', $end);
            } catch (\Exception $e) {
            }
        }

        return $this;
    }

    protected function addOrdering(Params $params, QueryBuilder $qb)
    {
        $qb->addOrderBy($this->alias('createdTs'), 'DESC');

        return parent::addOrdering($params, $qb);
    }
}
