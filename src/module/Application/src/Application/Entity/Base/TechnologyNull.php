<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Technology\CategoryInterface;
use Application\Entity\Base\Technology\CategoryNull;
use FzyCommon\Entity\BaseNull;

class TechnologyNull extends BaseNull implements TechnologyInterface
{
    /**
     * @return string
     */
    public function getName()
    {
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
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return new CategoryNull();
    }

    /**
     * @param CategoryInterface $categoryInterface
     *
     * @return $this
     */
    public function setCategory(CategoryInterface $categoryInterface)
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
