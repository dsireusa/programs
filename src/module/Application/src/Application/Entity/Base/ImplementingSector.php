<?php

namespace Application\Entity\Base;

use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Class ImplementingSector.
 *
 * @ORM\Entity
 * @ORM\Table(name="implementing_sector")
 */
class ImplementingSector extends Base implements ImplementingSectorInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="name")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program", mappedBy="implementing_sector", fetch="EXTRA_LAZY")
     *
     * @Annotation\Exclude()
     *
     * @var Collection
     */
    protected $programs;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": false}, name="active")
     *
     * @var bool
     */
    protected $active;

    public function __construct()
    {
        parent::__construct();
        $this->programs = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function addProgram(ProgramInterface $program)
    {
        $program->addSelfTo($this->programs);

        return $this;
    }

    /**
     * @param ProgramInterface $program
     *
     * @return bool
     */
    public function hasProgram(ProgramInterface $program)
    {
        return $this->programs->contains($program);
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function removeProgram(ProgramInterface $program)
    {
        $this->programs->removeElement($program);

        return $this;
    }

    /**
     * @return $this
     */
    public function clearPrograms()
    {
        /* @var $program \Application\Entity\Base\Program */
        foreach ($this->programs as $program) {
            $program->setImplementingSector(new ImplementingSectorNull());
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getPrograms()
    {
        return $this->programs->toArray();
    }

    /**
     * @return int
     */
    public function countPrograms()
    {
        return $this->programs->count();
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param bool $active
     *
     * @return $this;
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
            'active' => $this->isActive(),
        ));
    }
}
