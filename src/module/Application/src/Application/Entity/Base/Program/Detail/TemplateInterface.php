<?php

namespace Application\Entity\Base\Program\Detail;

use Application\Entity\Base\Program\TypeInterface;
use FzyCommon\Entity\BaseInterface;

interface TemplateInterface extends BaseInterface
{
    /**
     * @return TypeInterface
     */
    public function getProgramType();

    /**
     * @param TypeInterface $program
     *
     * @return $this
     */
    public function setProgramType(TypeInterface $program);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param $label
     *
     * @return $this
     */
    public function setLabel($label);

    /**
     * @return int
     */
    public function getDisplayOrder();

    /**
     * @param $order
     *
     * @return $this
     */
    public function setDisplayOrder($order);
}
