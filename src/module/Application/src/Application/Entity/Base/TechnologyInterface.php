<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Technology\CategoryInterface;
use FzyCommon\Entity\BaseInterface;

interface TechnologyInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     *
     * @return string
     */
    public function setName($name);

    /**
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * @param CategoryInterface $categoryInterface
     *
     * @return $this
     */
    public function setCategory(CategoryInterface $categoryInterface);

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
