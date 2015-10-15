<?php

namespace Application\Entity\Base\Program;

use FzyCommon\Entity\BaseInterface;

interface CategoryInterface extends BaseInterface
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
}
