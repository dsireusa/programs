<?php

namespace Application\Entity\Base\Technology\Category;

use Application\Entity\Base\Technology\CategoryInterface;
use FzyCommon\Entity\BaseInterface;

interface EnergyCategoryInterface extends BaseInterface
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
     * @return array
     */
    public function getCategories();

    /**
     * @param CategoryInterface $category
     *
     * @return bool
     */
    public function hasCategory(CategoryInterface $category);

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function addCategory(CategoryInterface $category);

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function removeCategory(CategoryInterface $category);

    /**
     * @return int
     */
    public function countCategories();
}
