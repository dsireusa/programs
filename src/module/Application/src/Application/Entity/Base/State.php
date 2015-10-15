<?php

namespace Application\Entity\Base;

use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class State.
 *
 * @ORM\Entity
 * @ORM\Table(name="state")
 */
class State extends Base implements StateInterface
{
    /**
     * @ORM\Column(type="string", length=45)
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=2)
     *
     * @var string
     */
    protected $abbreviation;

    /**
     * @ORM\Column(type="boolean", name="is_territory")
     *
     * @var bool
     */
    protected $territory;

    public function __construct()
    {
        $this->setTerritory(false);
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
            'abbreviation' => $this->getAbbreviation(),
            'is_territory' => $this->isTerritory(),
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
     * @return State
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAbbreviation()
    {
        return $this->abbreviation;
    }

    /**
     * @param mixed $abbreviation
     *
     * @return State
     */
    public function setAbbreviation($abbreviation)
    {
        $this->abbreviation = $abbreviation;

        return $this;
    }

    /**
     * @return bool
     */
    public function isTerritory()
    {
        return $this->territory;
    }

    /**
     * @param bool $territory
     *
     * @return $this
     */
    public function setTerritory($territory = true)
    {
        $this->territory = $territory;

        return $this;
    }
}
