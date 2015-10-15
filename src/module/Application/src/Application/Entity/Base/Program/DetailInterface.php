<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\HasProgramInterface;
use Application\Entity\Base\Program\Detail\TemplateInterface;
use FzyCommon\Entity\BaseInterface;

interface DetailInterface extends BaseInterface, HasProgramInterface
{
    /**
     * @return string
     */
    public function getValue();

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value);

    /**
     * @return string
     */
    public function getLabel();

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label);

    /**
     * @return int
     */
    public function getDisplayOrder();

    /**
     * @param int $displayOrder
     *
     * @return $this
     */
    public function setDisplayOrder($displayOrder);

    /**
     * @return TemplateInterface
     */
    public function getTemplate();

    /**
     * @param TemplateInterface $template
     *
     * @return $this
     */
    public function setTemplate(TemplateInterface $template);
}
