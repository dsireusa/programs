<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Utility\ZipCodeInterface;
use FzyCommon\Entity\BaseNull;

class UtilityNull extends BaseNull implements UtilityInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
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
    public function setState($state)
    {
        return $this;
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

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return $this
     */
    public function addZipCode(ZipCodeInterface $zipCode)
    {
        return $this;
    }

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return bool
     */
    public function hasZipCode(ZipCodeInterface $zipCode)
    {
        return false;
    }

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return $this
     */
    public function removeZipCode(ZipCodeInterface $zipCode)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getZipCodes()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countZipCodes()
    {
        return 0;
    }
}
