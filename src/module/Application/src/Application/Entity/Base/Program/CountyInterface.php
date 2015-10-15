<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\HasMultiProgramInterface;
use FzyCommon\Entity\BaseInterface;

interface CountyInterface extends BaseInterface, HasMultiProgramInterface
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
