<?php

namespace Application\Entity\Base\Program;

use FzyCommon\Entity\BaseInterface;

interface SearchLogInterface extends BaseInterface
{
    /**
     * @return \DateTime
     */
    public function getSearchTS();

    /**
     * @param mixed $date
     *
     * @return $this
     */
    public function setSearchTS($date);

    /**
     * @return float
     */
    public function getUserIP();

    /**
     * @param float $ip
     *
     * @return $this
     */
    public function setUserIP($ip);

    /**
     * @return string
     */
    public function getFilterType();

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setFilterType($type);

    /**
     * @return string
     */
    public function getText();

    /**
     * @param string $text
     *
     * @return $this;
     */
    public function setText($text);
}
