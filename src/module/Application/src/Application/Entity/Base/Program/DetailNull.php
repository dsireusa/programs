<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\Program\Detail\TemplateInterface;
use Application\Entity\Base\Program\Detail\TemplateNull;
use Application\Entity\Base\ProgramNull;
use Application\Entity\Base\ProgramInterface;
use FzyCommon\Entity\BaseNull;

class DetailNull extends BaseNull implements DetailInterface
{
    /**
     * @return ProgramInterface
     */
    public function getProgram()
    {
        return new ProgramNull();
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return '';
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
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
     * @param string $label
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
     * @param int $displayOrder
     *
     * @return $this
     */
    public function setDisplayOrder($displayOrder)
    {
        return $this;
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        return new TemplateNull();
    }

    /**
     * @param TemplateInterface $template
     *
     * @return $this
     */
    public function setTemplate(TemplateInterface $template)
    {
        return $this;
    }
}
