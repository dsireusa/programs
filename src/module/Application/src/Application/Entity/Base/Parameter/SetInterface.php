<?php

namespace Application\Entity\Base\Parameter;

use Application\Entity\Base\HasProgramInterface;
use Application\Entity\Base\ParameterInterface;
use FzyCommon\Entity\BaseInterface;
use Application\Entity\Base\Program\SectorInterface;
use Application\Entity\Base\TechnologyInterface;

interface SetInterface extends BaseInterface, HasProgramInterface
{
    /**
     * @param ParameterInterface $param
     *
     * @return $this
     */
    public function addParameter(ParameterInterface $param);

    /**
     * @param ParameterInterface $param
     *
     * @return bool
     */
    public function hasParameter(ParameterInterface $param);

    /**
     * @param ParameterInterface $city
     *
     * @return $this
     */
    public function removeParameter(ParameterInterface $param);

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @return int
     */
    public function countParameters();

    /**
     * @return $this
     */
    public function clearParameters();

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function addTechnology(TechnologyInterface $technology);

    /**
     * @param TechnologyInterface $technology
     *
     * @return bool
     */
    public function hasTechnology(TechnologyInterface $technology);

    /**
     * @param TechnologyInterface $city
     *
     * @return $this
     */
    public function removeTechnology(TechnologyInterface $technology);

    /**
     * @return array
     */
    public function getTechnologies();

    /**
     * @return int
     */
    public function countTechnologies();

    /**
     * @return $this
     */
    public function clearTechnologies();

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addSector(SectorInterface $sector);

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasSector(SectorInterface $sector);

    /**
     * @param SectorInterface $city
     *
     * @return $this
     */
    public function removeSector(SectorInterface $sector);

    /**
     * @return array
     */
    public function getSectors();

    /**
     * @return int
     */
    public function countSectors();

    /**
     * @return $this
     */
    public function clearSectors();
}
