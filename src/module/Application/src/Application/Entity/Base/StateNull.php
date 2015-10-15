<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\BaseNull;

class StateNull extends BaseNull implements StateInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getAbbreviation()
    {
        return '';
    }

    /**
     * @param $abbreviation
     *
     * @return $this
     */
    public function setAbbreviation($abbreviation)
    {
        return $this;
    }

    /**
     * @return bool
     */
    public function isTerritory()
    {
        return false;
    }

    /**
     * @param bool $territory
     *
     * @return $this
     */
    public function setTerritory($territory = true)
    {
        return $this;
    }
}
