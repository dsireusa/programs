<?php

namespace Application\Service\Search\Base\DQL;

use Doctrine\ORM\QueryBuilder;
use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;

/**
 * Class TechnologyCategory.
 */
class TechnologyCategory extends DQL
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
        return 'technologyCategoryId';
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
        return 'technology_categories';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Technology\Category';
    }

    /**
     * Alias for the primary repository in the DQL statement.
     *
     * @return string
     */
    public function getRepositoryAlias()
    {
        return 'tc';
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     * @param $search
     *
     * @return $this
     */
    protected function searchFilter(Params $params, QueryBuilder $qb, $search)
    {
        $fuzzySearch = "%{$search}%";
        $qb->andWhere($this->alias('name').' LIKE :search')->setParameter('search', $fuzzySearch);

        return $this;
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return mixed
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterByEnergyCategory($params, $qb);
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByEnergyCategory(Params $params, QueryBuilder $qb)
    {
        return $this->quickParamFilter($params, $qb, 'energyCategoryId', 'energyCategory');
    }
}
