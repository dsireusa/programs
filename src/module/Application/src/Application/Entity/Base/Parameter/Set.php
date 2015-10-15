<?php

namespace Application\Entity\Base\Parameter;

use Application\Entity\Base\ParameterInterface;
use Application\Entity\Base;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base\Program\SectorInterface;
use Application\Entity\Base\TechnologyInterface;

/**
 * Class Set.
 *
 * @ORM\Entity
 * @ORM\Table(name="parameter_set")
 */
class Set extends Base implements SetInterface
{
    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Technology")
     * @ORM\JoinTable(name="parameter_set_technology", joinColumns={
     *  @ORM\JoinColumn(name="set_id", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     *  @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     * }
     * )
     * @Annotation\Exclude()
     *
     * @var Collection
     */
    protected $technologies;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program\Sector")
     * @ORM\JoinTable(name="parameter_set_sector", joinColumns={
     *  @ORM\JoinColumn(name="set_id", referencedColumnName="id")
     * },
     * inverseJoinColumns={
     *  @ORM\JoinColumn(name="sector_id", referencedColumnName="id")
     * }
     * )
     * @Annotation\Exclude()
     *
     * @var Collection
     */
    protected $sectors;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id")
     * @Annotation\Exclude()
     *
     * @var ProgramInterface
     */
    protected $program;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Parameter", mappedBy="parameterSet", orphanRemoval=true)
     *
     * @Annotation\Exclude()
     *
     * @var Collection
     */
    protected $parameters;

    public function __construct()
    {
        parent::__construct();
        $this->parameters = new ArrayCollection();
        $this->technologies = new ArrayCollection();
        $this->sectors = new ArrayCollection();
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'programId' => $this->getProgram()->id(),
            'parameters' => $this->flatCollection($this->parameters, true),
            'technologies' => $this->flatCollection($this->technologies, true),
            'sectors' => $this->flatCollection($this->sectors, true),
        ));
    }

    /**
     * @return ProgramInterface
     */
    public function getProgram()
    {
        return $this->nullGet($this->program, new Base\ProgramNull());
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program)
    {
        if ($program !== $this->getProgram()) {
            $this->getProgram()->removeParameterSet($this);
            $this->program = $program->asDoctrineProperty();
            $program->addParameterSet($this);
        }

        return $this;
    }

    /**
     * @param ParameterInterface $param
     *
     * @return $this
     */
    public function addParameter(ParameterInterface $param)
    {
        $param->addSelfTo($this->parameters);

        return $this;
    }

    /**
     * @param ParameterInterface $param
     *
     * @return bool
     */
    public function hasParameter(ParameterInterface $param)
    {
        return $this->parameters->contains($param);
    }

    /**
     * @param ParameterInterface $param
     *
     * @return $this
     */
    public function removeParameter(ParameterInterface $param)
    {
        $this->parameters->removeElement($param);

        return $this;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters->toArray();
    }

    /**
     * @return int
     */
    public function countParameters()
    {
        return $this->parameters->count();
    }

    /**
     * @return $this
     */
    public function clearParameters()
    {
        $nullSet = new SetNull();
        /* @var $parameter \Application\Entity\Base\Parameter */
        foreach ($this->parameters as $parameter) {
            $parameter->setParameterSet($nullSet);
        }
        $this->parameters->clear();

        return $this;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addSector(SectorInterface $sector)
    {
        $sector->addSelfTo($this->sectors);

        return $this;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasSector(SectorInterface $sector)
    {
        return $this->sectors->contains($sector);
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function removeSector(SectorInterface $sector)
    {
        $this->sectors->removeElement($sector);

        return $this;
    }

    /**
     * @return array
     */
    public function getSectors()
    {
        return $this->sectors->toArray();
    }

    /**
     * @return int
     */
    public function countSectors()
    {
        return $this->sectors->count();
    }

    /**
     * @return $this
     */
    public function clearSectors()
    {
        $this->sectors->clear();

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

    /**
     * @return $this
     */
    public function clearTechnologies()
    {
        $this->technologies->clear();

        return $this;
    }
}
