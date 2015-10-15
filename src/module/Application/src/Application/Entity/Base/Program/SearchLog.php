<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class SearchLog.
 *
 * @ORM\Entity
 * @ORM\Table(name="search_log")
 */
class SearchLog extends Base implements SearchLogInterface
{
    const FILTER_TYPE_TEXT = 'Text';
    const FILTER_TYPE_TECHNOLOGY = 'Technology';
    const FILTER_TYPE_ENERGYCATEGORY = 'EnergyCategory';
    const FILTER_TYPE_TECHNOLOGYCATEGORY = 'TechnologyCategory';
    const FILTER_TYPE_UPDATED_FROM = 'UpdatedFromDate';
    const FILTER_TYPE_UPDATED_TO = 'UpdatedToDate';
    const FILTER_TYPE_EXPIRATION_FROM = 'ExpirationFromDate';
    const FILTER_TYPE_EXPIRATION_TO = 'ExpirationToDate';
    const FILTER_TYPE_CATEGORY = 'Category';
    const FILTER_TYPE_TYPE = 'Type';
    const FILTER_TYPE_IMPLEMENTINGSECTOR = 'ImplementingSector';
    const FILTER_TYPE_STATE = 'State';
    const FILTER_TYPE_COVERAGE_UTILITY = 'Utility';
    const FILTER_TYPE_COVERAGE_COUNTY = 'County';
    const FILTER_TYPE_COVERAGE_CITY = 'City';
    const FILTER_TYPE_COVERAGE_ZIPCODE = 'ZipCode';
    const FILTER_TYPE_SECTOR = 'Sector';

    /**
     * @ORM\Column(type="datetime", length=45, name="searchdate")
     *
     * @var \DateTime
     */
    protected $searchTS;

    /**
     * @ORM\Column(type="string", length=45, name="ip")
     *
     * @var string
     */
    protected $userIP;

    /**
     * @ORM\Column(type="string", length=45, name="filtertype")
     *
     * @var string
     */
    protected $filterType;

    /**
     * @ORM\Column(type="string", length=45, name="text")
     *
     * @var string
     */
    protected $text;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $filterText
     *
     * @return $this
     */
    public function setText($filterText)
    {
        $this->text = $filterText;

        return $this;
    }

    /**
     * @return string
     */
    public function getFilterType()
    {
        return $this->filterType;
    }

    /**
     * @param string $filterType
     *
     * @return $this
     */
    public function setFilterType($filterType)
    {
        $this->filterType = $filterType;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSearchTS()
    {
        return $this->searchTS;
    }

    /**
     * @param mixed $searchDate
     *
     * @return $this
     */
    public function setSearchTS($searchDate)
    {
        $this->searchTS = $searchDate;

        return $this;
    }

    /**
     * @return float
     */
    public function getUserIP()
    {
        return $this->userIP;
    }

    /**
     * @param float $userIP
     *
     * @return $this
     */
    public function setUserIP($userIP)
    {
        $this->userIP = $userIP;

        return $this;
    }
}
