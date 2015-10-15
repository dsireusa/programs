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
use FzyCommon\Entity\BaseInterface;
use Application\Entity\Base\Program\CountyInterface as ProgramCountyInterface;
use Application\Entity\Base\Program\AuthorityInterface;
use Application\Entity\Base\Program\ContactInterface as ProgramContactInterface;

interface ProgramInterface extends BaseInterface
{
    /**
     * @return StateInterface
     */
    public function getState();

    /**
     * @param StateInterface $state
     *
     * @return $this
     */
    public function setState(StateInterface $state);

    /**
     * @return bool
     */
    public function isEntireState();

    /**
     * @param bool $boolean
     *
     * @return $this
     */
    public function setEntireState($boolean = true);

    /**
     * @return ImplementingSectorInterface
     */
    public function getImplementingSector();

    /**
     * @param ImplementingSectorInterface $sector
     *
     * @return $this
     */
    public function setImplementingSector(ImplementingSectorInterface $sector);

    /**
     * @return CategoryInterface
     */
    public function getCategory();

    /**
     * @param CategoryInterface $category
     *
     * @return $this
     */
    public function setCategory(CategoryInterface $category);

    /**
     * @return TypeInterface
     */
    public function getType();

    /**
     * @param TypeInterface $type
     *
     * @return $this
     */
    public function setType(TypeInterface $type);

    /**
     * @return UserInterface
     */
    public function getCreatedByUser();

    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function setCreatedByUser(UserInterface $user);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name);

    /**
     * @return \DateTime
     */
    public function getUpdatedTs();

    /**
     * @param $ts
     *
     * @return $this
     */
    public function setUpdatedTs($ts);

    /**
     * @return \DateTime
     */
    public function getCreatedTs();

    /**
     * @param $ts
     *
     * @return $this
     */
    public function setCreatedTs($ts);

    /**
     * @return bool
     */
    public function isPublished();

    /**
     * @param bool $bool
     *
     * @return $this
     */
    public function setPublished($bool);

    /**
     * @return string
     */
    public function getWebsiteUrl();

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setWebsiteUrl($url);

    /**
     * @return string
     */
    public function getAdministrator();

    /**
     * @param string $administrator
     *
     * @return $this
     */
    public function setAdministrator($administrator);

    /**
     * @return string
     */
    public function getFundingSource();

    /**
     * @param string $fundingSource
     *
     * @return $this
     */
    public function setFundingSource($fundingSource);

    /**
     * @return string
     */
    public function getBudget();

    /**
     * @param string $budget
     *
     * @return $this
     */
    public function setBudget($budget);

    /**
     * @return \DateTime
     */
    public function getStartDate();

    /**
     * @param $date
     *
     * @return $this
     */
    public function setStartDate($date);

    /**
     * @return \DateTime
     */
    public function getEndDate();

    /**
     * @param $date
     *
     * @return $this
     */
    public function setEndDate($date);

    /**
     * @return string
     */
    public function getStartDateText();

    /**
     * @param string $startDateText
     *
     * @return $this
     */
    public function setStartDateText($startDateText);

    /**
     * @return string
     */
    public function getEndDateText();

    /**
     * @param string $endDateText
     *
     * @return $this
     */
    public function setEndDateText($endDateText);

    /**
     * @return string
     */
    public function getSummary();

    /**
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary);

    /**
     * @param string $additionalTechnologies
     *
     * @return $this
     */
    public function setAdditionalTechnologies($additionalTechnologies);

    /**
     * @return string
     */
    public function getAdditionalTechnologies();

    /**
     * @return array
     */
    public function getDetails();

    /**
     * @param DetailInterface $detail
     *
     * @return bool
     */
    public function hasDetail(DetailInterface $detail);

    /**
     * @param DetailInterface $detail
     *
     * @return $this
     */
    public function addDetail(DetailInterface $detail);

    /**
     * @param DetailInterface $detail
     *
     * @return $this
     */
    public function removeDetail(DetailInterface $detail);

    /**
     * Removes details.
     *
     * @return $this
     */
    public function clearDetails();

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function addTechnology(TechnologyInterface $technology);

    /**
     * @param TechnologyInterface $technology
     *
     * @return bool
     */
    public function hasTechnology(TechnologyInterface $technology);

    /**
     * @param TechnologyInterface $technology
     *
     * @return $this
     */
    public function removeTechnology(TechnologyInterface $technology);

    /**
     * @return array
     */
    public function getTechnologies();

    /**
     * @return int
     */
    public function countTechnologies();

    /**
     * Removes all technologies.
     *
     * @return $this
     */
    public function clearTechnologies();

    /**
     * @param ProgramCountyInterface $county
     *
     * @return $this
     */
    public function addCounty(ProgramCountyInterface $county);

    /**
     * @param ProgramCountyInterface $county
     *
     * @return bool
     */
    public function hasCounty(ProgramCountyInterface $county);

    /**
     * @param ProgramCountyInterface $county
     *
     * @return $this
     */
    public function removeCounty(ProgramCountyInterface $county);

    /**
     * @return array
     */
    public function getCounties();

    /**
     * @return int
     */
    public function countCounties();

    /**
     * Removes all counties.
     *
     * @return $this
     */
    public function clearCounties();

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function addCity(CityInterface $city);

    /**
     * @param CityInterface $city
     *
     * @return bool
     */
    public function hasCity(CityInterface $city);

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function removeCity(CityInterface $city);

    /**
     * @return array
     */
    public function getCities();

    /**
     * @return int
     */
    public function countCities();

    /**
     * Removes all cities.
     *
     * @return $this
     */
    public function clearCities();

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function addUtility(UtilityInterface $utility);

    /**
     * @param UtilityInterface $utility
     *
     * @return bool
     */
    public function hasUtility(UtilityInterface $utility);

    /**
     * @param UtilityInterface $utility
     *
     * @return $this
     */
    public function removeUtility(UtilityInterface $utility);

    /**
     * @return array
     */
    public function getUtilities();

    /**
     * @return int
     */
    public function countUtilities();

    /**
     * @return $this
     */
    public function clearUtilities();

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return $this
     */
    public function addZipCode(ZipCodeInterface $zipcode);

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return bool
     */
    public function hasZipCode(ZipCodeInterface $zipcode);

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return $this
     */
    public function removeZipCode(ZipCodeInterface $zipcode);

    /**
     * @return array
     */
    public function getZipCodes();

    /**
     * @return int
     */
    public function countZipCodes();

    /**
     * Removes all zipcodes.
     *
     * @return $this
     */
    public function clearZipCodes();

    /**
     * @param AuthorityInterface $authority
     *
     * @return $this
     */
    public function addAuthority(AuthorityInterface $authority);

    /**
     * @param AuthorityInterface $authority
     *
     * @return bool
     */
    public function hasAuthority(AuthorityInterface $authority);

    /**
     * @param AuthorityInterface $authority
     *
     * @return $this
     */
    public function removeAuthority(AuthorityInterface $authority);

    /**
     * @return array
     */
    public function getAuthorities();

    /**
     * @return int
     */
    public function countAuthorities();

    /**
     * Removes all authorities.
     *
     * @return $this
     */
    public function clearAuthorities();

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function addParameterSet(SetInterface $paramSet);

    /**
     * @param SetInterface $paramSet
     *
     * @return bool
     */
    public function hasParameterSet(SetInterface $paramSet);

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function removeParameterSet(SetInterface $paramSet);

    /**
     * @return array
     */
    public function getParameterSets();

    /**
     * @return int
     */
    public function countParameterSets();

    /**
     * Removes all parameter sets.
     *
     * @return $this
     */
    public function clearParameterSets();

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function addSubscriptionMemo(SubscriptionMemoInterface $subMemo);

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return bool
     */
    public function hasSubscriptionMemo(SubscriptionMemoInterface $subMemo);

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function removeSubscriptionMemo(SubscriptionMemoInterface $subMemo);

    /**
     * @return array
     */
    public function getSubscriptionMemos();

    /**
     * @return int
     */
    public function countSubscriptionMemos();

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function addProgramMemo(ProgramMemoInterface $programMemo);

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return bool
     */
    public function hasProgramMemo(ProgramMemoInterface $programMemo);

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function removeProgramMemo(ProgramMemoInterface $programMemo);

    /**
     * @return array
     */
    public function getProgramMemos();

    /**
     * @return int
     */
    public function countProgramMemos();

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addSector(SectorInterface $sector);

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasSector(SectorInterface $sector);

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function removeSector(SectorInterface $sector);

    /**
     * @return array
     */
    public function getSectors();

    /**
     * @return int
     */
    public function countSectors();

    /**
     * @return $this
     */
    public function clearSectors();

    /**
     * @param ProgramContactInterface $contact
     *
     * @return $this
     */
    public function addContact(ProgramContactInterface $contact);

    /**
     * @param ProgramContactInterface $contact
     *
     * @return bool
     */
    public function hasContact(ProgramContactInterface $contact);

    /**
     * @param ProgramContactInterface $contact
     *
     * @return $this
     */
    public function removeContact(ProgramContactInterface $contact);

    /**
     * @return array
     */
    public function getContacts();

    /**
     * @return int
     */
    public function countContacts();

    /**
     * Removes all program contact relations.
     *
     * @return $this
     */
    public function clearContacts();
}
