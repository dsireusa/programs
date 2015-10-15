<?php

namespace Application\Entity\Base\Program;

use FzyCommon\Entity\BaseInterface;

interface TypeInterface extends BaseInterface
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
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function setCategory($category);
}
