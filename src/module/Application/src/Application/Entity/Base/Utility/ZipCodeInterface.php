<?php

namespace Application\Entity\Base\Utility;

use Application\Entity\Base\HasMultiProgramInterface;
use FzyCommon\Entity\BaseInterface;
use Application\Entity\Base\UtilityInterface;
use Application\Entity\Base\Program\CityInterface;
use Application\Entity\Base\StateInterface;
use Application\Entity\Base\Program\CountyInterface;

interface ZipCodeInterface extends BaseInterface, HasMultiProgramInterface
{
    /**
     * @return string
     */
    public function getZipCode();

    /**
     * @param string $zipCode
     *
     * @return $this
     */
    public function setZipCode($zipCode);

    /**
     * @return CityInterface
     */
    public function getCity();

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function setCity(CityInterface $city);

    /**
     * @return StateInterface
     */
    public function getState();

    /**
     * @param StateInterface $state
     *
     * @return $this
     */
    public function setState(StateInterface $state);

    /**
     * @return CountyInterface
     */
    public function getCounty();

    /**
     * @param CountyInterface $county
     *
     * @return $this
     */
    public function setCounty(CountyInterface $county);

    /**
     * @return float
     */
    public function getLatitude();

    /**
     * @param float $lat
     *
     * @return $this
     */
    public function setLatitude($lat);

    /**
     * @return float
     */
    public function getLongitude();

    /**
     * @param float $long
     *
     * @return $this
     */
    public function setLongitude($long);

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function addUtility(UtilityInterface $utility);

    /**
     * @param UtilityInterface $utility
     *
     * @return bool
     */
    public function hasUtility(UtilityInterface $utility);

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function removeUtility(UtilityInterface $utility);

    /**
     * @return array
     */
    public function getUtilities();

    /**
     * @return int
     */
    public function countUtilities();
}
