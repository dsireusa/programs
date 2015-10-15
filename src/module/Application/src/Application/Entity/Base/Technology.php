<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Technology\CategoryNull;
use Application\Entity\Base;
use Application\Entity\Base\Technology\CategoryInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Contact.
 *
 * @ORM\Entity
 * @ORM\Table(name="technology")
 */
class Technology extends Base implements TechnologyInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="name")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Technology\Category")
     * @ORM\JoinColumn(name="technology_category_id", referencedColumnName="id")
     *
     * @var CategoryInterface
     */
    protected $category;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program", mappedBy="technologies", fetch="EXTRA_LAZY")
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
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->nullGet($this->category, new CategoryNull());
    }

    /**
     * @param CategoryInterface $category
     */
    public function setCategory(CategoryInterface $category)
    {
        $this->category = $category->asDoctrineProperty();

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
        $program->addTechnology($this);

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
            'category' => $this->getCategory()->getName(),
            'categoryId' => $this->getCategory()->id(),
            'energyCategoryId' => $this->getCategory()->getEnergyCategory()->id(),
        ));
    }
}
