<?php

namespace Application\Entity\Base\Utility;

use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Base\UtilityInterface;
use Application\Entity\Base\Program\CityNull;
use Application\Entity\Base\Program\CityInterface;
use Application\Entity\Base\Program\CountyNull;
use Application\Entity\Base\Program\CountyInterface;
use Application\Entity\Base\StateNull;
use Application\Entity\Base\StateInterface;

/**
 * Class ZipCode.
 *
 * @ORM\Entity
 * @ORM\Table(name="zipcode")
 */
class ZipCode extends Base implements ZipCodeInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="zipcode")
     *
     * @var string
     */
    protected $zipcode;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     *
     * @var \Application\Entity\Base\Program\CityInterface
     */
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     *
     * @var \Application\Entity\Base\StateInterface
     */
    protected $state;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program\County")
     * @ORM\JoinColumn(name="county_id", referencedColumnName="id")
     *
     * @var \Application\Entity\Base\Program\CountyInterface
     */
    protected $county;

    /**
     * @ORM\Column(type="decimal", name="latitude")
     *
     * @var float
     */
    protected $latitude;

    /**
     * @ORM\Column(type="decimal", name="longitude")
     *
     * @var float
     */
    protected $longitude;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Utility", mappedBy="zipCodes", fetch="EXTRA_LAZY")
     *
     * @var Collection
     */
    protected $utilities;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program", mappedBy="zipCodes", fetch="EXTRA_LAZY")
     *
     * @var ArrayCollection
     */
    protected $programs;

    public function __construct()
    {
        parent::__construct();
        $this->utilities = new ArrayCollection();
        $this->programs = new ArrayCollection();
    }

    /**
     * @return CityInterface
     */
    public function getCity()
    {
        return $this->nullGet($this->city, new CityNull());
    }

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function setCity(CityInterface $city)
    {
        $this->city = $city->asDoctrineProperty();

        return $this;
    }

    /**
     * @return CountyInterface
     */
    public function getCounty()
    {
        return $this->nullGet($this->county, new CountyNull());
    }

    /**
     * @param CountyInterface $county
     *
     * @return $this
     */
    public function setCounty(CountyInterface $county)
    {
        $this->county = $county->asDoctrineProperty();

        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     *
     * @return $this
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     *
     * @return $this
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
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
    public function setState(StateInterface $state)
    {
        $this->state = $state->asDoctrineProperty();

        return $this;
    }

    /**
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string $zipcode
     *
     * @return $this
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function addUtility(UtilityInterface $utility)
    {
        $utility->addSelfTo($this->utilities);

        return $this;
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return bool
     */
    public function hasUtility(UtilityInterface $utility)
    {
        return $this->utilities->contains($utility);
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function removeUtility(UtilityInterface $utility)
    {
        $this->utilities->removeElement($utility);

        return $this;
    }

    /**
     * @return array
     */
    public function getUtilities()
    {
        return $this->utilities->toArray();
    }

    /**
     * @return int
     */
    public function countUtilities()
    {
        return $this->utilities->count();
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function addProgram(ProgramInterface $program)
    {
        $program->addSelfTo($this->programs);
        $program->addZipCode($this);

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
        $program->removeZipCode($this);

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

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'name' => $this->getZipcode(),
            'city' => $this->getCity()->id(),
            'county' => $this->getCounty()->id(),
            'state' => $this->getState()->id(),
        ));
    }
}
