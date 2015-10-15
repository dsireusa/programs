<?php

namespace Application\Entity\Base;

interface HasMultiProgramInterface
{
    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function addProgram(ProgramInterface $program);

    /**
     * @param ProgramInterface $program
     *
     * @return bool
     */
    public function hasProgram(ProgramInterface $program);

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function removeProgram(ProgramInterface $program);

    /**
     * @return array
     */
    public function getPrograms();

    /**
     * @return int
     */
    public function countPrograms();
}
