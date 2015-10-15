<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\BaseNull;

class ImplementingSectorNull extends BaseNull implements ImplementingSectorInterface
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
     * @return $this
     */
    public function clearPrograms()
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
    public function isActive()
    {
        return false;
    }

    /**
     * @param bool $active
     *
     * @return $this;
     */
    public function setActive($active)
    {
        return $this;
    }
}
