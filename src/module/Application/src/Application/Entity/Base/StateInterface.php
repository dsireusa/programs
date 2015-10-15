<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\BaseInterface;

interface StateInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getAbbreviation();

    /**
     * @param $abbreviation
     *
     * @return $this
     */
    public function setAbbreviation($abbreviation);

    /**
     * @return bool
     */
    public function isTerritory();

    /**
     * @param bool $territory
     *
     * @return $this
     */
    public function setTerritory($territory = true);
}
