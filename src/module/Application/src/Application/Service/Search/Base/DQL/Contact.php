<?php

namespace Application\Service\Search\Base\DQL;

use Doctrine\ORM\QueryBuilder;
use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;

class Contact extends DQL
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
        return 'contactId';
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
        return 'contacts';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Contact';
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

    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterByValidSelect2($params, $qb);
    }

    public function filterByValidSelect2(Params $params, QueryBuilder $qb)
    {
        if ($params->get('select2')) {
            $qb->andWhere('CONCAT('.$this->alias('firstName').', '.$this->alias('lastName').','.$this->alias('organizationName').','.$this->alias('email').') IS NOT NULL');
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
        $fuzzySearch = '%'.$search.'%';
        $strippedSearch = '%'.preg_replace('/\W/i', '', $search).'%';
        $this->safeJoin($qb, 'state', 's');
        $qb->andWhere($qb->expr()->orX(
            $this->alias('firstName').' LIKE :search',
            $this->alias('lastName').' LIKE :search',
            's.name LIKE :search',
            'CONCAT('.$this->alias('firstName').','.$this->alias('lastName').') LIKE :strippedSearch',
            'CONCAT('.$this->alias('lastName').','.$this->alias('firstName').') LIKE :strippedSearch',
            $this->alias('email').' LIKE :search',
            $this->alias('organizationName').' LIKE :search'
        ))->setParameter('search', $fuzzySearch)
            ->setParameter('strippedSearch', $strippedSearch);

        return $this;
    }

    /**
     * If there is some ordering that needs to be applied, do it here.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addOrdering(Params $params, QueryBuilder $qb)
    {
        $this->orderByDataTablesParams($params, $qb);
        $order = $this->getDataTablesSortOrder($params);
        /*
         * sort by lastname, firstname regardless of any other search criteria.
         * NOTE: this should come after all other ordering as the least important. That way if another column
         * is sorted on, that gets priority and only in the case of a tie will the name sort be apparent
         */
        $qb->addOrderBy($this->alias('lastName'), $order)
            ->addOrderBy($this->alias('firstName'), $order)
            ->addOrderBy($this->alias('organizationName'), $order)
            ->addOrderBy($this->alias('email'), $order);

        return $this;
    }
}
