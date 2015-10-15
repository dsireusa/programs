<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Parameter\SetInterface;
use Application\Entity\Base\Program\CategoryInterface;
use Application\Entity\Base\Program\CityInterface;
use Application\Entity\Base\Program\DetailInterface;
use Application\Entity\Base\Program\MemoInterface as ProgramMemoInterface;
use Application\Entity\Base\Program\TypeInterface;
use Application\Entity\Base\Program\SectorInterface;
use Application\Entity\Base\Subscription\MemoInterface as SubscriptionMemoInterface;
use Application\Entity\Base\Utility\ZipCodeInterface;
use FzyCommon\Entity\BaseNull;
use Zend\I18n\Validator\DateTime;
use Application\Entity\Base\Program\CountyInterface as ProgramCountyInterface;
use Application\Entity\Base\Program\AuthorityInterface;
use Application\Entity\Base\Program\ContactInterface as ProgramContactInterface;

class ProgramNull extends BaseNull implements ProgramInterface
{
    /**
     * @return StateInterface
     */
    public function getState()
    {
        return new StateNull();
    }
    /**
     * @param StateInterface $state
     *
     * @return $this
     */
    public function setState(StateInterface $state)
    {
        return $this;
    }
    /**
     * @return bool
     */
    public function isEntireState()
    {
        return false;
    }
    /**
     * @param bool $boolean
     *
     * @return $this
     */
    public function setEntireState($boolean = true)
    {
        return $this;
    }
    /**
     * @return ImplementingSectorInterface
     */
    public function getImplementingSector()
    {
        return new ImplementingSectorNull();
    }
    /**
     * @param ImplementingSectorInterface $sector
     *
     * @return $this
     */
    public function setImplementingSector(ImplementingSectorInterface $sector)
    {
        return $this;
    }
    /**
     * @return CategoryInterface
     */
    public function getCategory()
    {
        return new CategoryNull();
    }
    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function setCategory(CategoryInterface $category)
    {
        return $this;
    }
    /**
     * @return TypeInterface
     */
    public function getType()
    {
        return new TypeNull();
    }
    /**
     * @param TypeInterface $type
     *
     * @return $this
     */
    public function setType(TypeInterface $type)
    {
        return $this;
    }
    /**
     * @return UserInterface
     */
    public function getCreatedByUser()
    {
        return new UserNull();
    }
    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function setCreatedByUser(UserInterface $user)
    {
        return $this;
    }
    /**
     * @return string
     */
    public function getCode()
    {
        return;
    }
    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        return $this;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return;
    }
    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getUpdatedTs()
    {
        return new DateTime();
    }
    /**
     * @param $ts
     *
     * @return $this
     */
    public function setUpdatedTs($ts)
    {
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return new DateTime();
    }
    /**
     * @param $ts
     *
     * @return $this
     */
    public function setCreatedTs($ts)
    {
        return $this;
    }
    /**
     * @return bool
     */
    public function isPublished()
    {
        return false;
    }
    /**
     * @param bool $bool
     *
     * @return $this
     */
    public function setPublished($bool)
    {
        return $this;
    }
    /**
     * @return string
     */
    public function getWebsiteUrl()
    {
        return;
    }
    /**
     * @param string $url
     *
     * @return $this
     */
    public function setWebsiteUrl($url)
    {
        return $this;
    }
    /**
     * @return string
     */
    public function getAdministrator()
    {
        return;
    }
    /**
     * @param string $administrator
     *
     * @return $this
     */
    public function setAdministrator($administrator)
    {
        return $this;
    }
    /**
     * @return string
     */
    public function getFundingSource()
    {
        return;
    }
    /**
     * @param string $fundingSource
     *
     * @return $this
     */
    public function setFundingSource($fundingSource)
    {
        return $this;
    }
    /**
     * @return string
     */
    public function getBudget()
    {
        return;
    }
    /**
     * @param string $budget
     *
     * @return $this
     */
    public function setBudget($budget)
    {
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return new DateTime();
    }
    /**
     * @param $date
     *
     * @return $this
     */
    public function setStartDate($date)
    {
        return $this;
    }
    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return new DateTime();
    }
    /**
     * @param $date
     *
     * @return $this
     */
    public function setEndDate($date)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getStartDateText()
    {
        return;
    }

    /**
     * @param string $startDateText
     *
     * @return $this
     */
    public function setStartDateText($startDateText)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getEndDateText()
    {
        return;
    }

    /**
     * @param string $endDateText
     *
     * @return $this
     */
    public function setEndDateText($endDateText)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getSummary()
    {
        return;
    }
    /**
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        return;
    }

    /**
     * @param string $additionalTechnologies
     *
     * @return $this
     */
    public function setAdditionalTechnologies($additionalTechnologies)
    {
        return;
    }

    /**
     * @return string
     */
    public function getAdditionalTechnologies()
    {
        return;
    }

    /**
     * @return array
     */
    public function getDetails()
    {
        return array();
    }

    /**
     * @param DetailInterface $detail
     *
     * @return bool
     */
    public function hasDetail(DetailInterface $detail)
    {
        return false;
    }

    /**
     * @param DetailInterface $detail
     *
     * @return $this
     */
    public function addDetail(DetailInterface $detail)
    {
        return $this;
    }

    /**
     * @param DetailInterface $detail
     *
     * @return $this
     */
    public function removeDetail(DetailInterface $detail)
    {
        return $this;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function addTechnology(TechnologyInterface $technology)
    {
        return $this;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return bool
     */
    public function hasTechnology(TechnologyInterface $technology)
    {
        return false;
    }

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function removeTechnology(TechnologyInterface $technology)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getTechnologies()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countTechnologies()
    {
        return 0;
    }

    /**
     * Removes all technologies.
     *
     * @return $this
     */
    public function clearTechnologies()
    {
        return $this;
    }

    /**
     * @param ProgramCountyInterface $county
     *
     * @return $this
     */
    public function addCounty(ProgramCountyInterface $county)
    {
        return $this;
    }

    /**
     * @param ProgramCountyInterface $county
     *
     * @return bool
     */
    public function hasCounty(ProgramCountyInterface $county)
    {
        return false;
    }

    /**
     * @param ProgramCountyInterface $county
     *
     * @return $this
     */
    public function removeCounty(ProgramCountyInterface $county)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getCounties()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countCounties()
    {
        return 0;
    }

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function addCity(CityInterface $city)
    {
        return $this;
    }

    /**
     * @param CityInterface $city
     *
     * @return bool
     */
    public function hasCity(CityInterface $city)
    {
        return false;
    }

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function removeCity(CityInterface $city)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getCities()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countCities()
    {
        return 0;
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function addUtility(UtilityInterface $utility)
    {
        return $this;
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return bool
     */
    public function hasUtility(UtilityInterface $utility)
    {
        return false;
    }

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function removeUtility(UtilityInterface $utility)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getUtilities()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countUtilities()
    {
        return 0;
    }

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return $this
     */
    public function addZipCode(ZipCodeInterface $zipcode)
    {
        return $this;
    }

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return bool
     */
    public function hasZipCode(ZipCodeInterface $zipcode)
    {
        return false;
    }

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return $this
     */
    public function removeZipCode(ZipCodeInterface $zipcode)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getZipCodes()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countZipCodes()
    {
        return 0;
    }

    /**
     * @param AuthorityInterface $authority
     *
     * @return $this
     */
    public function addAuthority(AuthorityInterface $authority)
    {
        return $this;
    }

    /**
     * @param AuthorityInterface $authority
     *
     * @return bool
     */
    public function hasAuthority(AuthorityInterface $authority)
    {
        return false;
    }

    /**
     * @param AuthorityInterface $authority
     *
     * @return $this
     */
    public function removeAuthority(AuthorityInterface $authority)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getAuthorities()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countAuthorities()
    {
        return 0;
    }

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function addParameterSet(SetInterface $paramSet)
    {
        return $this;
    }

    /**
     * @param SetInterface $paramSet
     *
     * @return bool
     */
    public function hasParameterSet(SetInterface $paramSet)
    {
        return false;
    }

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function removeParameterSet(SetInterface $paramSet)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getParameterSets()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countParameterSets()
    {
        return 0;
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function addSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return $this;
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return bool
     */
    public function hasSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return false;
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function removeSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getSubscriptionMemos()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countSubscriptionMemos()
    {
        return 0;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function addProgramMemo(ProgramMemoInterface $programMemo)
    {
        return $this;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return bool
     */
    public function hasProgramMemo(ProgramMemoInterface $programMemo)
    {
        return false;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function removeProgramMemo(ProgramMemoInterface $programMemo)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getProgramMemos()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countProgramMemos()
    {
        return 0;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addSector(SectorInterface $sector)
    {
        return $this;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasSector(SectorInterface $sector)
    {
        return false;
    }

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function removeSector(SectorInterface $sector)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getSectors()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countSectors()
    {
        return 0;
    }

    /**
     * @param ProgramContactInterface $contact
     *
     * @return $this
     */
    public function addContact(ProgramContactInterface $contact)
    {
        return $this;
    }

    /**
     * @param ProgramContactInterface $contact
     *
     * @return bool
     */
    public function hasContact(ProgramContactInterface $contact)
    {
        return false;
    }

    /**
     * @param ProgramContactInterface $contact
     *
     * @return $this
     */
    public function removeContact(ProgramContactInterface $contact)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getContacts()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countContacts()
    {
        return 0;
    }

    /**
     * Removes all counties.
     *
     * @return $this
     */
    public function clearCounties()
    {
        return $this;
    }

    /**
     * Removes all cities.
     *
     * @return $this
     */
    public function clearCities()
    {
        return $this;
    }

    /**
     * Removes all zipcodes.
     *
     * @return $this
     */
    public function clearZipCodes()
    {
        return $this;
    }

    /**
     * Removes all authorities.
     *
     * @return $this
     */
    public function clearAuthorities()
    {
        return $this;
    }

    /**
     * Removes all parameter sets.
     *
     * @return $this
     */
    public function clearParameterSets()
    {
        return $this;
    }

    /**
     * Removes all program contact relations.
     *
     * @return $this
     */
    public function clearContacts()
    {
        return $this;
    }

    /**
     * Removes details.
     *
     * @return $this
     */
    public function clearDetails()
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function clearUtilities()
    {
        return $this;
    }

    /**
     * @return $this
     */
    public function clearSectors()
    {
        return $this;
    }
}
