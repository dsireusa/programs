<?php

namespace Application\Entity\Base;

interface HasProgramInterface
{
    /**
     * @return ProgramInterface
     */
    public function getProgram();

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program);
}
