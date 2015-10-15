<?php

namespace Application\Entity\Base\Program;

use FzyCommon\Entity\BaseNull;

class SearchLogNull extends BaseNull implements SearchLogInterface
{
    /**
     * @return string
     */
    public function getText()
    {
        return;
    }

    /**
     * @param string $filterText
     *
     * @return $this
     */
    public function setText($filterText)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getFilterType()
    {
        return;
    }

    /**
     * @param string $filterType
     *
     * @return $this
     */
    public function setFilterType($filterType)
    {
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getSearchTS()
    {
        return new \DateTime();
    }

    /**
     * @param mixed $searchDate
     *
     * @return $this
     */
    public function setSearchTS($searchDate)
    {
        return $this;
    }

    /**
     * @return float
     */
    public function getUserIP()
    {
        return 0;
    }

    /**
     * @param float $userIP
     *
     * @return $this
     */
    public function setUserIP($userIP)
    {
        return $this;
    }
}
