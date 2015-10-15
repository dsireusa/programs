<?php

namespace Application\Entity\Base\Technology;

use Application\Entity\Base\TechnologyInterface;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
use Application\Entity\Base\Technology\Category\EnergyCategoryInterface;

/**
 * Class Category.
 *
 * @ORM\Entity
 * @ORM\Table(name="technology_category")
 */
class Category extends Base implements CategoryInterface
{
    /**
     * @ORM\Column(type="string", length=45)
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Technology\Category\EnergyCategory", inversedBy="categories")
     * @ORM\JoinColumn(name="energy_category_id", referencedColumnName="id")
     *
     * @var EnergyCategoryInterface
     */
    protected $energyCategory;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Technology", mappedBy="technology_category", fetch="EXTRA_LAZY")
     *
     * @Annotation\Exclude()
     *
     * @var Collection
     */
    protected $technologies;

    public function __construct()
    {
        parent::__construct();
        $this->technologies = new ArrayCollection();
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
     * @return EnergyCategoryInterface
     */
    public function getEnergyCategory()
    {
        return $this->nullGet($this->energyCategory, new Base\Technology\Category\EnergyCategoryNull());
    }

    /**
     * @param string $energyCategory
     *
     * @return $this
     */
    public function setEnergyCategory(EnergyCategoryInterface $energyCategory)
    {
        $this->energyCategory = $energyCategory->asDoctrineProperty();

        return $this;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function addTechnology(TechnologyInterface $technology)
    {
        $technology->addSelfTo($this->technologies);

        return $this;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return bool
     */
    public function hasTechnology(TechnologyInterface $technology)
    {
        return $this->technologies->contains($technology);
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function removeTechnology(TechnologyInterface $technology)
    {
        $this->technologies->removeElement($technology);

        return $this;
    }

    /**
     * @return $this
     */
    public function clearTechnologies()
    {
        /* @var $technology \Application\Entity\Base\Technology */
        foreach ($this->technologies as $technology) {
            $technology->setCategory(new CategoryNull());
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getTechnologies()
    {
        return $this->technologies->toArray();
    }

    /**
     * @return int
     */
    public function countTechnologies()
    {
        return $this->technologies->count();
    }
    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
            'energyCategory' => $this->getEnergyCategory()->id(),
            'energyCategoryObj' => $this->getEnergyCategory()->flatten(),
        ));
    }
}
