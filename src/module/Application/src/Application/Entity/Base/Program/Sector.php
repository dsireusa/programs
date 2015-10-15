<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * Class Sector.
 *
 * @ORM\Entity
 * @ORM\Table(name="sector")
 */
class Sector extends Base implements SectorInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="name")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=45, name="fieldname")
     *
     * @var string
     */
    protected $fieldname;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program", mappedBy="sectors", fetch="EXTRA_LAZY")
     *
     * @var Collection
     */
    protected $programs;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program\Sector", inversedBy="children")
     *
     * @var Sector
     */
    protected $parent;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program\Sector", mappedBy="parent", fetch="EXTRA_LAZY")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     *
     * @var Collection
     */
    protected $children;

    /**
     * @ORM\Column(type="boolean", name="is_selectable")
     *
     * @var bool
     */
    protected $selectable;

    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->programs = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getFieldname()
    {
        return $this->fieldname;
    }

    /**
     * @param string $fieldname
     */
    public function setFieldname($fieldname)
    {
        $this->fieldname = $fieldname;

        return $this;
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
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
            'parentId' => $this->getParent()->id(),
            'selectable' => $this->isSelectable(),
            'countChildren' => $this->countChildren(),
            'children' => $this->getChildren(),
        ));
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function addProgram(ProgramInterface $program)
    {
        $program->addSelfTo($this->programs);
        $program->addSector($this);

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
        $program->removeSector($this);

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
    public function isSelectable()
    {
        return $this->selectable;
    }

    /**
     * @param bool $selectable
     *
     * @return $this
     */
    public function setSelectable($selectable = true)
    {
        $this->selectable = $selectable;

        return $this;
    }

    /**
     * @return SectorInterface
     */
    public function getParent()
    {
        return $this->nullGet($this->parent, new SectorNull());
    }

    /**
     * @param SectorInterface $parent
     *
     * @return $this
     */
    public function setParent(SectorInterface $parent)
    {
        $this->parent = $parent->asDoctrineProperty();

        return $this;
    }

    /**
     * @return array
     */
    public function getChildren()
    {
        return $this->children->toArray();
    }

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasChild(SectorInterface $sector)
    {
        return $this->children->contains($sector);
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addChild(SectorInterface $sector)
    {
        $sector->getParent()->removeChild($sector);
        $sector->addSelfTo($this->children);
        $sector->setParent($this);

        return $this;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function removeChild(SectorInterface $sector)
    {
        $this->children->removeElement($sector);
        $sector->setParent(new SectorNull());

        return $this;
    }

    /**
     * @return int
     */
    public function countChildren()
    {
        return $this->children->count();
    }
}
