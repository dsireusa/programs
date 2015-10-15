<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\Program\Detail\TemplateNull;
use Application\Entity\Base\Program\Detail\TemplateInterface;
use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base\ProgramNull;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Detail.
 *
 * @ORM\Entity
 * @ORM\Table(name="program_detail")
 */
class Detail extends Base implements DetailInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program", inversedBy="program_details")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id")
     *
     * @var ProgramInterface
     */
    protected $program;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    protected $label;

    /**
     * @ORM\Column(type="text", length=255)
     *
     * @var string
     */
    protected $value;

    /**
     * @ORM\Column(type="integer", options={"default": 0}, nullable=false, name="display_order")
     *
     * @var int
     */
    protected $displayOrder;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program\Detail\Template")
     * @ORM\JoinColumn(name="template_id", referencedColumnName="id")
     *
     * @var Template
     */
    protected $template;

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return ProgramInterface
     */
    public function getProgram()
    {
        return $this->nullGet($this->program, new ProgramNull());
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program)
    {
        if ($program !== $this->getProgram()) {
            $this->getProgram()->removeDetail($this);
            $this->program = $program->asDoctrineProperty();
            $program->addDetail($this);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return int
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * @param int $displayOrder
     *
     * @return $this
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    /**
     * @return TemplateInterface
     */
    public function getTemplate()
    {
        return $this->nullGet($this->template, new TemplateNull());
    }

    /**
     * @param TemplateInterface $template
     *
     * @return $this
     */
    public function setTemplate(TemplateInterface $template)
    {
        $this->template = $template->asDoctrineProperty();

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'label' => $this->getLabel(),
            'value' => $this->getValue(),
            'displayOrder' => $this->getDisplayOrder(),
            'templateId' => $this->getTemplate()->id(),
        ));
    }
}
