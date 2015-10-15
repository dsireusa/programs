<?php

namespace Application\Entity\Base\Program\Detail;

use Application\Entity\Base\Program\TypeInterface;
use Application\Entity\Base\Program\TypeNull;
use FzyCommon\Entity\BaseNull;

class TemplateNull extends BaseNull implements TemplateInterface
{
    /**
     * @return TypeInterface
     */
    public function getProgramType()
    {
        return new TypeNull();
    }

    /**
     * @param TypeInterface $program
     *
     * @return $this
     */
    public function setProgramType(TypeInterface $program)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return '';
    }

    /**
     * @param $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getDisplayOrder()
    {
        return 0;
    }

    /**
     * @param $order
     *
     * @return $this
     */
    public function setDisplayOrder($order)
    {
        return $this;
    }
}
