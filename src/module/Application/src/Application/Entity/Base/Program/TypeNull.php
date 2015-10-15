<?php

namespace Application\Entity\Base\Program;

use FzyCommon\Entity\BaseNull;

class TypeNull extends BaseNull implements TypeInterface
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
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return new CategoryNull();
    }

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        return $this;
    }
}
