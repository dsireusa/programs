<?php

namespace Application\Entity\Base\Utility;

use Application\Entity\Base\Program\CityInterface;
use Application\Entity\Base\Program\CityNull;
use Application\Entity\Base\Program\CountyInterface;
use Application\Entity\Base\Program\CountyNull;
use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base\StateInterface;
use Application\Entity\Base\StateNull;
use FzyCommon\Entity\BaseNull;
use Application\Entity\Base\UtilityInterface;

class ZipCodeNull extends BaseNull implements ZipCodeInterface
{
    /**
     * @return string
     */
    public function getZipCode()
    {
        return;
    }
    /**
     * @param string $zipCode
     *
     * @return $this
     */
    public function setZipCode($zipCode)
    {
        return $this;
    }
    /**
     * @return CityInterface
     */
    public function getCity()
    {
        return new CityNull();
    }
    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function setCity(CityInterface $city)
    {
        return $this;
    }
    /**
     * @return StateInterface
     */
    public function getState()
    {
        return new StateNull();
    }
    /**
     * @param StateInterface $state
     *
     * @return $this
     */
    public function setState(StateInterface $state)
    {
        return $this;
    }
    /**
     * @return CountyInterface
     */
    public function getCounty()
    {
        return new CountyNull();
    }
    /**
     * @param CountyInterface $county
     *
     * @return $this
     */
    public function setCounty(CountyInterface $county)
    {
        return $this;
    }
    /**
     * @return float
     */
    public function getLatitude()
    {
        return 0;
    }
    /**
     * @param float $lat
     *
     * @return $this
     */
    public function setLatitude($lat)
    {
        return $this;
    }
    /**
     * @return float
     */
    public function getLongitude()
    {
        return 0;
    }
    /**
     * @param float $long
     *
     * @return $this
     */
    public function setLongitude($long)
    {
        return $this;
    }
    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function addUtility(UtilityInterface $utility)
    {
        return $this;
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return bool
     */
    public function hasUtility(UtilityInterface $utility)
    {
        return false;
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function removeUtility(UtilityInterface $utility)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getUtilities()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countUtilities()
    {
        return 0;
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function addProgram(ProgramInterface $program)
    {
        return $this;
    }

    /**
     * @param ProgramInterface $program
     *
     * @return bool
     */
    public function hasProgram(ProgramInterface $program)
    {
        return false;
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function removeProgram(ProgramInterface $program)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getPrograms()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countPrograms()
    {
        return 0;
    }
}
