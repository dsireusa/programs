<?php

namespace Application\Entity\Base\Program;

use FzyCommon\Entity\BaseNull;

class CategoryNull extends BaseNull implements CategoryInterface
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
}
