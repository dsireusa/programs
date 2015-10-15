<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\ProgramInterface;
use FzyCommon\Entity\BaseNull;

class SectorNull extends BaseNull implements SectorInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return;
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
    public function getFieldName()
    {
        return;
    }

    /**
     * @param $name
     *
     * @return $this
     */
    public function setFieldName($name)
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
     * @return bool
     */
    public function isSelectable()
    {
        return false;
    }

    /**
     * @param bool $selectable
     *
     * @return $this
     */
    public function setSelectable($selectable = true)
    {
        return $this;
    }

    /**
     * @return SectorInterface
     */
    public function getParent()
    {
        return new self();
    }

    /**
     * @param SectorInterface $parent
     *
     * @return $this
     */
    public function setParent(SectorInterface $parent)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return array();
    }

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasChild(SectorInterface $sector)
    {
        return false;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addChild(SectorInterface $sector)
    {
        return $this;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function removeChild(SectorInterface $sector)
    {
        return $this;
    }

    /**
     * @return int
     */
    public function countChildren()
    {
        return 0;
    }
}
