<?php

namespace Application\Entity\Base\Parameter;

use Application\Entity\Base\ParameterInterface;
use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base\ProgramNull;
use FzyCommon\Entity\BaseNull;
use Application\Entity\Base\TechnologyInterface;
use Application\Entity\Base\Program\SectorInterface;

class SetNull extends BaseNull implements SetInterface
{
    /**
     * @return ProgramInterface
     */
    public function getProgram()
    {
        return new ProgramNull();
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program)
    {
        return $this;
    }

    /**
     * @param ParameterInterface $param
     *
     * @return $this
     */
    public function addParameter(ParameterInterface $param)
    {
        return $this;
    }

    /**
     * @param ParameterInterface $param
     *
     * @return bool
     */
    public function hasParameter(ParameterInterface $param)
    {
        return false;
    }

    /**
     * @param ParameterInterface $city
     *
     * @return $this
     */
    public function removeParameter(ParameterInterface $param)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countParameters()
    {
        return 0;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addSector(SectorInterface $sector)
    {
        return $this;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasSector(SectorInterface $sector)
    {
        return false;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function removeSector(SectorInterface $sector)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getSectors()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countSectors()
    {
        return 0;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function addTechnology(TechnologyInterface $technology)
    {
        return $this;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return bool
     */
    public function hasTechnology(TechnologyInterface $technology)
    {
        return false;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function removeTechnology(TechnologyInterface $technology)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getTechnologies()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countTechnologies()
    {
        return 0;
    }

    /**
     * @return $this
     */
    public function clearParameters()
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function clearTechnologies()
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function clearSectors()
    {
        return $this;
    }
}
