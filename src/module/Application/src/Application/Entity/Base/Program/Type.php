<?php

namespace Application\Entity\Base\Program;

use Zend\Form\Annotation;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Type.
 *
 * @ORM\Entity
 * @ORM\Table(name="program_type")
 */
class Type extends Base implements TypeInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="name")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program\Category")
     * @ORM\JoinColumn(name="program_category_id", referencedColumnName="id")
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\Attributes({"required": true})
     * @Annotation\Options({
     *      "label":"Program Category",
     *      })
     *
     * @var CategoryInterface
     */
    protected $category;

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
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return $this->nullGet($this->category, new CategoryNull());
    }

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function setCategory($category)
    {
        $this->category = $category->asDoctrineProperty();

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
            'category' => $this->getCategory()->id(),
            'categoryObj' => $this->category->flatten(),
        ));
    }
}
