<?php

namespace Application\Entity\Base\Technology\Category;

use Application\Entity\Base\Technology\CategoryInterface;
use FzyCommon\Entity\BaseNull;

class EnergyCategoryNull extends BaseNull implements EnergyCategoryInterface
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
     * @return array
     */
    public function getCategories()
    {
        return array();
    }

    /**
     * @param CategoryInterface $category
     *
     * @return bool
     */
    public function hasCategory(CategoryInterface $category)
    {
        return false;
    }

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function addCategory(CategoryInterface $category)
    {
        return $this;
    }

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function removeCategory(CategoryInterface $category)
    {
        return $this;
    }

    /**
     * @return int
     */
    public function countCategories()
    {
        return 0;
    }
}
