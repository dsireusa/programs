<?php

namespace Application\Service\Search\Base\DQL;

use Application\Controller\ProgramController;
use Application\Entity\Base\Program\SearchLog;
use Doctrine\ORM\QueryBuilder;
use FzyAuth\Entity\Base\UserInterface;
use FzyCommon\Util\Params;
use Application\Service\Search\Base\DQL;
use Zend\Dom\Document\Query;

class Program extends DQL
{
    private $auth = null;
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
        return 'programId';
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
        return 'programs';
    }

    /**
     * This function is used by the class to get
     * the entity's repository to be returned.
     *
     * @return mixed
     */
    protected function getRepository()
    {
        return 'Application\Entity\Base\Program';
    }

    /**
     * Alias for the primary repository in the DQL statement.
     *
     * @return string
     */
    public function getRepositoryAlias()
    {
        return 'p';
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
        $qb->andWhere($qb->expr()->orX(
            $this->alias('name').' LIKE :search',
            $this->alias('code').' LIKE :search'
        ))->setParameter('search', $fuzzySearch);

        return $this;
    }

    /**
     * save a SearchLog Entity for the current search.
     *
     * @param $type
     * @param $searchValue
     */
    private function saveSearchLogEntity($type, $searchValue)
    {
        $em = $this->em();
        $searchLog = new SearchLog();
        $searchLog->setSearchTS(new \DateTime());
        $searchLog->setText($searchValue);
        $searchLog->setFilterType($type);
        $searchLog->setUserIP($_SERVER['REMOTE_ADDR']);
        $em->persist($searchLog);
        $em->flush();
    }

    /**
     * check authentication to know whether or not a search log entry should be saved.
     *
     * @param $type
     * @param $searchValue
     */
    private function handleSearchLog($type, $searchValue)
    {
        //save reference to auth service
        if (!$this->auth) {
            $sm = $this->getServiceLocator();
            $this->auth = $sm->get('zfcuser_auth_service');
        }
        $value = $searchValue;
        if (is_array($searchValue)) {
            $value = implode(',', $searchValue);
        }
        //save a new search log entity if current user is not admin
        if (!$this->auth->hasIdentity()  || $this->auth->getIdentity()->getRole() == UserInterface::ROLE_USER) {
            $this->saveSearchLogEntity($type, $value);
        }
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
        $order = $this->getDataTablesSortOrder($params);
        $sort = $this->getDataTablesSortColumn($params);
        if ($sort) {
            switch ($sort) {
                case 'stateObj.abbreviation':
                    $this->safeJoin($qb, 'state', 's');
                    $qb->addOrderBy('s.abbreviation', $order);
                    break;
                case 'categoryObj.name':
                    $this->safeJoin($qb, 'category', 'c');
                    $qb->addOrderBy('c.name', $order);
                    break;
                case 'typeObj.name':
                    $this->safeJoin($qb, 'type', 't');
                    $qb->addOrderBy('t.name', $order);
                    break;
                default:
                    $qb->addOrderBy($this->alias($sort), $order);
                    break;
            }
        }

        return $this;
    }

    /** Process to pass string values to display for 'Visible to Public' column instead of boolean values
     * @param $entity
     * @param Params             $params
     * @param array|\Traversable $results
     * @param bool               $asEntity
     *
     * @return array
     */
    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        $object = parent::process($entity, $params, $results, $asEntity);
        if (!$asEntity) {
            $object['published'] = $entity->isPublished() ? 'Yes' : 'No';
        }

        return $object;
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
        parent::addFilters($params, $qb);

        if ($params->get('territories', false)) {
            $this->filterToTerritories($params, $qb);
        }

        return $this->filterByTechnology($params, $qb)
            ->filterByUpdatedFromDate($params, $qb)
            ->filterByUpdatedToDate($params, $qb)
            ->filterByExpirationFromDate($params, $qb)
            ->filterByExpirationToDate($params, $qb)
            ->filterByCategory($params, $qb)
            ->filterByType($params, $qb)
            ->filterByImplementingSector($params, $qb)
            ->filterByUtility($params, $qb)
            ->filterByCounty($params, $qb)
            ->filterByCity($params, $qb)
            ->filterByZipCode($params, $qb)
            ->filterByEligibleSector($params, $qb)
            ->filterByState($params, $qb);
    }

    /**
     * filters to only return Programs that have been "published" (Published==true).
     *
     * @param Params       $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function filterByPublished(Params $params, QueryBuilder $qb)
    {
        $qb->andWhere($this->alias('published').'=true');

        return $this;
    }

    protected function filterHasName(Params $params, QueryBuilder $qb)
    {
        $qb->andWhere($this->alias('name')." != ''");
        $qb->andWhere($this->alias('name').' IS NOT NULL');

        return $this;
    }

    protected function filterByTechnology(Params $params, QueryBuilder $qb)
    {
        if ($params->has('technology')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_TECHNOLOGY, $params->get('technology'));
        }

        return $this->addWhereMemberOfFilter($params, $qb, 'technology', 'technologies');
    }
    protected function filterByUpdatedFromDate(Params $params, QueryBuilder $qb)
    {
        if ($params->has('updated')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_UPDATED_FROM, $params->get('updatedfrom'));
        }
        $this->addDateFromFilter($params, $qb, 'updatedfrom', 'updatedTs');

        return $this;
    }
    protected function filterByUpdatedToDate(Params $params, QueryBuilder $qb)
    {
        if ($params->has('updated')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_UPDATED_TO, $params->get('updatedto'));
        }
        $this->addDateToFilter($params, $qb, 'updatedto', 'updatedTs');

        return $this;
    }
    protected function filterByExpirationFromDate(Params $params, QueryBuilder $qb)
    {
        if ($params->has('expired')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_EXPIRATION_FROM, $params->get('expiredfrom'));
        }
        $this->addDateFromFilter($params, $qb, 'expiredfrom', 'endDate');

        return $this;
    }
    protected function filterByExpirationToDate(Params $params, QueryBuilder $qb)
    {
        if ($params->has('expired')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_EXPIRATION_TO, $params->get('expiredto'));
        }
        $this->addDateToFilter($params, $qb, 'expiredto', 'endDate');

        return $this;
    }
    protected function addDateFromFilter(Params $params, QueryBuilder $qb, $requestParameterName, $queryParameterName = null)
    {
        if ($queryParameterName === null) {
            $queryParameterName = $requestParameterName;
        }
        if ($params->has($requestParameterName)) {
            $qb->andWhere($this->alias($queryParameterName).' >= :'.$requestParameterName)->setParameter($requestParameterName, new \DateTime($params->get($requestParameterName)[0]), \Doctrine\DBAL\Types\Type::DATE);
        }

        return $this;
    }
    protected function addDateToFilter(Params $params, QueryBuilder $qb, $requestParameterName, $queryParameterName = null)
    {
        if ($queryParameterName === null) {
            $queryParameterName = $requestParameterName;
        }
        if ($params->has($requestParameterName)) {
            $qb->andWhere($this->alias($queryParameterName).' <= :'.$requestParameterName)->setParameter($requestParameterName, new \DateTime($params->get($requestParameterName)[0]), \Doctrine\DBAL\Types\Type::DATE);
        }

        return $this;
    }

    protected function filterByCategory(Params $params, QueryBuilder $qb)
    {
        if ($params->has('category')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_CATEGORY, $params->get('category'));
        }

        return $this->addWhereInFilter($params, $qb, 'category');
    }
    protected function filterByType(Params $params, QueryBuilder $qb)
    {
        if ($params->has('type')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_TYPE, $params->get('type'));
        }

        return $this->addWhereInFilter($params, $qb, 'type');
    }
    protected function filterByImplementingSector(Params $params, QueryBuilder $qb)
    {
        if ($params->has('implementingsector')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_IMPLEMENTINGSECTOR, $params->get('implementingsector'));
        }

        return $this->addWhereInFilter($params, $qb, 'implementingsector', 'implementingSector');
    }
    protected function filterByState(Params $params, QueryBuilder $qb)
    {
        if ($params->has('state')) {
            //Always display "Federal" standards: id = 11
            $params->set('state', array_merge((array) $params->get('state'), array(11)));
            $this->handleSearchLog(SearchLog::FILTER_TYPE_STATE, $params->get('state'));
        }

        return $this->addWhereInFilter($params, $qb, 'state');
    }
    protected function filterToTerritories(Params $params, QueryBuilder $qb)
    {
        $this->handleSearchLog(SearchLog::FILTER_TYPE_STATE, ProgramController::STATE_FILTER_TO_TERRITORIES);
        $this->safeJoin($qb, 'state', 's');
        $qb->andWhere('s.territory = 1');

        return $this;
    }

    private function getAdditionalExpressionsForCoverageAreaFilters(QueryBuilder $qb)
    {
        $additionalExpressions = array();
        //include programs that are for the entire state and have an implementing sector of 'State' (i.e. id = 1);
        $additionalExpressions[] = $qb->expr()->orX($this->getRepositoryAlias().'.entireState = 1 AND '.$this->getRepositoryAlias().'.implementingSector = 1');
        //include programs that are federal programs (i.e. have an implementing sector of 4)
        $additionalExpressions[] = $qb->expr()->orX($this->getRepositoryAlias().'.implementingSector = 4');

        return $additionalExpressions;
    }

    /** When Utility is selected, results include
     * Utility via "Programs_has_Utilities"
     * State Programs (marked IsEntireState)
     * Federal programs.
     */
    protected function filterByUtility(Params $params, QueryBuilder $qb)
    {
        $additionalExpressions = array();
        if ($params->has('utility')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_COVERAGE_UTILITY, $params->get('utility'));
            if ($params->has('state')) {
                $additionalExpressions = $this->getAdditionalExpressionsForCoverageAreaFilters($qb);
            }
            $qb->andWhere(implode(' OR ', array_merge($this->getExpressionsForWhereMembersOf($params, $qb, 'utility', 'utilities'), $additionalExpressions)));
        }

        return $this;
    }
    protected function filterByCounty(Params $params, QueryBuilder $qb)
    {
        $additionalExpressions = array();
        if ($params->has('county')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_COVERAGE_COUNTY, $params->get('county'));
            if ($params->has('state')) {
                $additionalExpressions = $this->getAdditionalExpressionsForCoverageAreaFilters($qb);
            }
            $qb->andWhere(implode(' OR ', array_merge($this->getExpressionsForWhereMembersOf($params, $qb, 'county', 'counties'), $additionalExpressions)));
        }

        return $this;
    }
    protected function filterByCity(Params $params, QueryBuilder $qb)
    {
        $additionalExpressions = array();
        if ($params->has('city')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_COVERAGE_CITY, $params->get('city'));
            if ($params->has('state')) {
                $additionalExpressions = $this->getAdditionalExpressionsForCoverageAreaFilters($qb);
            }
            if ($params->has('city-county')) {
                //Include programs that are associated with the county that the city is associated with (via the zipcodes table)
                $additionalExpressions = array_merge($this->getExpressionsForWhereMembersOf(Params::create(array('county' => $params->get('city-county'))), $qb, 'county', 'counties'), $additionalExpressions);
            }
            $qb->andWhere(implode(' OR ', array_merge($this->getExpressionsForWhereMembersOf($params, $qb, 'city', 'cities'), $additionalExpressions)));
        }

        return $this;
    }
    protected function filterByZipCode(Params $params, QueryBuilder $qb)
    {
        $additionalExpressions = array();
        if ($params->has('zipcode')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_COVERAGE_ZIPCODE, $params->get('zipcode'));
            if ($params->has('state')) {
                $additionalExpressions = $this->getAdditionalExpressionsForCoverageAreaFilters($qb);
            }
            if ($params->has('zip-county')) {
                //Include programs that are associated with the county that the zipcode is associated with
                $additionalExpressions = array_merge($this->getExpressionsForWhereMembersOf(Params::create(array('county' => $params->get('zip-county'))), $qb, 'county', 'counties'), $additionalExpressions);
            }
            if ($params->has('zip-city')) {
                //Include programs that are associated with the city that the zipcode is associated with
                $additionalExpressions = array_merge($this->getExpressionsForWhereMembersOf(Params::create(array('city' => $params->get('zip-city'))), $qb, 'city', 'cities'), $additionalExpressions);
            }
            if ($params->has('zip-utility')) {
                //Include programs that are associated with the utilities that the zipcode is associated with
                $additionalExpressions = array_merge($this->getExpressionsForWhereMembersOf(Params::create(array('utility' => $params->get('zip-utility'))), $qb, 'utility', 'utilities'), $additionalExpressions);
            }
            $qb->andWhere(implode(' OR ', array_merge($this->getExpressionsForWhereMembersOf($params, $qb, 'zipcode', 'zipCodes'), $additionalExpressions)));
        }

        return $this;
    }

    protected function filterByEligibleSector(Params $params, QueryBuilder $qb)
    {
        if ($params->has('sector')) {
            $this->handleSearchLog(SearchLog::FILTER_TYPE_SECTOR, $params->get('sector'));
        }

        return $this->addWhereMemberOfFilter($params, $qb, 'sector', 'sectors');
    }
}
