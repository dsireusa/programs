<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\ProgramInterface;
use FzyCommon\Entity\BaseNull;

class CountyNull extends BaseNull implements CountyInterface
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
