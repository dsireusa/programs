<?php

namespace Application\Entity\Base\Technology;

use Application\Entity\Base\Technology\Category\EnergyCategoryInterface;
use FzyCommon\Entity\BaseInterface;
use Application\Entity\Base\TechnologyInterface;

interface CategoryInterface extends BaseInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * @return EnergyCategoryInterface
     */
    public function getEnergyCategory();

    /**
     * @param EnergyCategoryInterface $category
     *
     * @return $this
     */
    public function setEnergyCategory(EnergyCategoryInterface $category);

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
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function removeTechnology(TechnologyInterface $technology);

    /**
     * @return $this
     */
    public function clearTechnologies();

    /**
     * @return array
     */
    public function getTechnologies();

    /**
     * @return int
     */
    public function countTechnologies();
}
