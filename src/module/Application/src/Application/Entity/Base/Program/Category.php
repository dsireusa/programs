<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category.
 *
 * @ORM\Entity
 * @ORM\Table(name="program_category")
 */
class Category extends Base implements CategoryInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="name")
     *
     * @var string
     */
    protected $name;

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

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
        ));
    }
}
