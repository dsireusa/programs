<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Utility\ZipCodeInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Utility.
 *
 * @ORM\Entity
 * @ORM\Table(name="utility")
 */
class Utility extends Base implements UtilityInterface
{
    /**
     * @ORM\Column(type="string", length=45)
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=10, name="utility_id")
     *
     * @var string
     */
    protected $utilityId;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     
     * @var StateInterface
     */
    protected $state;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program", mappedBy="utilities", fetch="EXTRA_LAZY")
     *
     * @var ArrayCollection
     */
    protected $programs;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Utility\ZipCode", inversedBy="utilities")
     * @ORM\JoinTable(name="utility_zipcode")
     *
     * @var ArrayCollection
     */
    protected $zipCodes;

    public function __construct()
    {
        parent::__construct();
        $this->programs = new ArrayCollection();
        $this->zipCodes = new ArrayCollection();
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
     * @return $this;
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEIAId()
    {
        return $this->utilityId;
    }

    /**
     * @param string $EIAId
     *
     * @return $this;
     */
    public function setEIAId($EIAId)
    {
        $this->utilityId = $EIAId;
    }

    /**
     * @return StateInterface
     */
    public function getState()
    {
        return $this->nullGet($this->state, new StateNull());
    }

    /**
     * @param StateInterface $state
     *
     * @return $this
     */
    public function setState($state)
    {
        $this->state = $state->asDoctrineProperty();

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
        $program->addUtility($this);

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
        $program->removeUtility($this);

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
     * @param ZipCodeInterface $zipCode
     *
     * @return $this
     */
    public function addZipCode(ZipCodeInterface $zipCode)
    {
        $zipCode->addSelfTo($this->zipCodes);

        return $this;
    }

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return bool
     */
    public function hasZipCode(ZipCodeInterface $zipCode)
    {
        return $this->zipCodes->contains($zipCode);
    }

    /**
     * @param ZipCodeInterface $zipCode
     *
     * @return $this
     */
    public function removeZipCode(ZipCodeInterface $zipCode)
    {
        $this->zipCodes->removeElement($zipCode);

        return $this;
    }

    /**
     * @return array
     */
    public function getZipCodes()
    {
        return $this->zipCodes->toArray();
    }

    /**
     * @return int
     */
    public function countZipCodes()
    {
        return $this->zipCodes->count();
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getName(),
            'state' => $this->getState()->id(),
            'EIA_id' => $this->getEIAId(),
        ));
    }
}
