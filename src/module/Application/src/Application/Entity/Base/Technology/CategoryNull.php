<?php

namespace Application\Entity\Base\Technology;

use Application\Entity\Base\Technology\Category\EnergyCategoryInterface;
use Application\Entity\Base\Technology\Category\EnergyCategoryNull;
use FzyCommon\Entity\BaseNull;
use Application\Entity\Base\TechnologyInterface;

class CategoryNull extends BaseNull implements CategoryInterface
{
    /**
     * @return string
     */
    public function getName()
    {
        return '';
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
     * @return EnergyCategoryInterface
     */
    public function getEnergyCategory()
    {
        return new EnergyCategoryNull();
    }

    /**
     * @param EnergyCategoryInterface $category
     *
     * @return $this
     */
    public function setEnergyCategory(EnergyCategoryInterface $category)
    {
        return $this;
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
     * @param MiscLineInterface $technology
     *
     * @return bool
     */
    public function hasTechnology(TechnologyInterface $technology)
    {
        return false;
    }

    /**
     * @param MiscLineInterface $technology
     *
     * @return $this
     */
    public function removeTechnology(TechnologyInterface $technology)
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
}
