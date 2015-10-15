<?php

namespace Application\Service\Search\Base\DQL;

use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;
use Doctrine\ORM\QueryBuilder;
use Zend\Filter\Null;

class Sector extends DQL
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
        return 'sectorId';
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
        return 'sectors';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Program\Sector';
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
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterByParent($params, $qb)->filterById($params, $qb);
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByParent(Params $params, QueryBuilder $qb)
    {
        if ($params->hasKey('parentId')) {
            $parentId = $params->get('parentId');
            if ($parentId == null) {
                $qb->andWhere($this->alias('parent').' IS NULL');
            } else {
                $qb->andWhere($this->alias('parent').' = :parent')->setParameter('parent', $params->get('parentId'));
            }
        }

        return $this;
    }

    protected function filterById(Params $params, QueryBuilder $qb)
    {
        if ($params->has('id')) {
            return $this->addWhereInFilter($params, $qb, 'id');
        }
    }
}
