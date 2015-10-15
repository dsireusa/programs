<?php

namespace Application\Entity\Base\Technology\Category;

use Application\Entity\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Base\Technology\CategoryInterface;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="energy_category")
 * Class EnergyCategoryNull
 */
class EnergyCategory extends Base implements EnergyCategoryInterface
{
    /**
     * @ORM\Column(length=255, nullable=false)
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Technology\Category", mappedBy="energyCategory", fetch="EXTRA_LAZY")
     *
     * @var Collection
     */
    protected $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
        ));
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return array
     */
    public function getCategories()
    {
        return $this->categories->toArray();
    }

    /**
     * @param CategoryInterface $category
     *
     * @return bool
     */
    public function hasCategory(CategoryInterface $category)
    {
        return $this->categories->contains($category);
    }

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function addCategory(CategoryInterface $category)
    {
        $category->addSelfTo($this->categories);

        return $this;
    }

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function removeCategory(CategoryInterface $category)
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return int
     */
    public function countCategories()
    {
        return $this->categories->count();
    }
}
