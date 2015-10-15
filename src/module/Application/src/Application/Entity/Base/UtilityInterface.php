<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Utility\ZipCodeInterface;
use FzyCommon\Entity\BaseInterface;

interface UtilityInterface extends BaseInterface, HasMultiProgramInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * @return StateInterface
     */
    public function getState();

    /**
     * @param StateInterface $state
     *
     * @return $this
     */
    public function setState($state);

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return $this
     */
    public function addZipCode(ZipCodeInterface $zipCode);

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return bool
     */
    public function hasZipCode(ZipCodeInterface $zipCode);

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return $this
     */
    public function removeZipCode(ZipCodeInterface $zipCode);

    /**
     * @return array
     */
    public function getZipCodes();

    /**
     * @return int
     */
    public function countZipCodes();
}
