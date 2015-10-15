<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base;
use Application\Entity\Base\ProgramInterface;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
use Doctrine\Common\Collections\Collection;

/**
 * Class County.
 *
 * @ORM\Entity
 * @ORM\Table(name="county")
 */
class County extends Base implements CountyInterface
{
    /**
     * @ORM\Column(type="string", length=255, name="name")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"required": true})
     * @Annotation\Options({
     *      "label": "County Name",
     *      "autorender": {
     *          "ngModel": "name"
     *      }
     * })
     * @Annotation\Required(true)
     * @Annotation\Filter({"name": "StringTrim"})
     * @Annotation\ErrorMessage("Please specify an county name.")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     *
     * @var \Application\Entity\Base\StateInterface
     */
    protected $state;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program", mappedBy="counties", fetch="EXTRA_LAZY")
     *
     * @var Collection
     */
    protected $programs;

    public function __construct()
    {
        parent::__construct();
        $this->programs = new ArrayCollection();
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
        ));
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
        $program->addCounty($this);

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
        $program->removeCounty($this);

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
}
