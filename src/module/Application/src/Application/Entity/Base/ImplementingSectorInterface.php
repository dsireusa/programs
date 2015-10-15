<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\BaseInterface;

interface ImplementingSectorInterface extends BaseInterface
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
     * @return $this
     */
    public function clearPrograms();

    /**
     * @return array
     */
    public function getPrograms();

    /**
     * @return int
     */
    public function countPrograms();

    /**
     * @return bool
     */
    public function isActive();

    /**
     * @param bool $active
     *
     * @return $this;
     */
    public function setActive($active);
}
