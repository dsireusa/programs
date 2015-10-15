<?php

namespace Application\Entity\Base\Program\Detail;

use Application\Entity\Base\Program\TypeInterface;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="program_detail_template")
 * Class Template
 */
class Template extends Base implements TemplateInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program\Type")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     *
     * @var TypeInterface
     */
    protected $programType;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var
     */
    protected $label;

    /**
     * @ORM\Column(type="integer", name="display_order")
     *
     * @var
     */
    protected $displayOrder;

    /**
     * @return mixed
     */
    public function getDisplayOrder()
    {
        return $this->displayOrder;
    }

    /**
     * @param mixed $displayOrder
     *
     * @return $this
     */
    public function setDisplayOrder($displayOrder)
    {
        $this->displayOrder = $displayOrder;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param mixed $label
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return TypeInterface
     */
    public function getProgramType()
    {
        return $this->nullGet($this->programType, new Base\Program\TypeNull());
    }

    /**
     * @param TypeInterface $programType
     *
     * @return $this
     */
    public function setProgramType(TypeInterface $programType)
    {
        $this->programType = $programType->asDoctrineProperty();

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'label' => $this->getLabel(),
            'displayOrder' => $this->getDisplayOrder(),
            'programTypeId' => $this->getProgramType()->id(),
        ));
    }
}
