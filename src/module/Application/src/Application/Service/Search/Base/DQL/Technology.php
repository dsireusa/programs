<?php

namespace Application\Service\Search\Base\DQL;

use Doctrine\ORM\QueryBuilder;
use Application\Service\Search\Base\DQL;
use FzyCommon\Util\Params;

class Technology extends DQL
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
        return 'technologyId';
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
        return 'technologies';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Technology';
    }

    /**
     * Alias for the primary repository in the DQL statement.
     *
     * @return string
     */
    public function getRepositoryAlias()
    {
        return 't';
    }

    /**
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return mixed
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterByActive($params, $qb)->filterByTechnologyCategory($params, $qb)->filterByEnergyCategory($params, $qb);
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
     * filter to return all technology categories that share the same energyCategory.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByTechnologyCategory(Params $params, QueryBuilder $qb)
    {
        return $this->quickParamFilter($params, $qb, 'technologyCategoryId', 'category');
    }

    /**
     * Filters technologies by the energy category.
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByEnergyCategory(Params $params, QueryBuilder $qb)
    {
        if ($params->has('energyCategoryId')) {
            $this->safeJoin($qb, 'category', 'c');
            $qb->andWhere('c.energyCategory = :energyCategory')->setParameter('energyCategory', $params->get('energyCategoryId'));
        }

        return $this;
    }

    /**
     * filters to only return Implementing Sectors that are "active" (Active==true).
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByActive(Params $params, QueryBuilder $qb)
    {
        $qb->andWhere($this->alias('active').'=true');

        return $this;
    }
}
