<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity\Base;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Program extends \Application\Entity\Base\Program implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'name', 'websiteUrl', 'administrator', 'fundingSource', 'budget', 'startDate', 'startDateText', 'endDate', 'endDateText', 'summary', 'state', 'entireState', 'createdByUser', 'implementingSector', 'category', 'type', 'code', 'updatedTs', 'createdTs', 'published', 'counties', 'cities', 'utilities', 'zipCodes', 'contacts', 'parameterSets', 'details', 'authorities', 'sectors', 'programMemos', 'subscriptionMemos', 'technologies', 'additionalTechnologies', 'id');
        }

        return array('__isInitialized__', 'name', 'websiteUrl', 'administrator', 'fundingSource', 'budget', 'startDate', 'startDateText', 'endDate', 'endDateText', 'summary', 'state', 'entireState', 'createdByUser', 'implementingSector', 'category', 'type', 'code', 'updatedTs', 'createdTs', 'published', 'counties', 'cities', 'utilities', 'zipCodes', 'contacts', 'parameterSets', 'details', 'authorities', 'sectors', 'programMemos', 'subscriptionMemos', 'technologies', 'additionalTechnologies', 'id');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Program $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function isEntireState()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isEntireState', array());

        return parent::isEntireState();
    }

    /**
     * {@inheritDoc}
     */
    public function setEntireState($boolean = true)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEntireState', array($boolean));

        return parent::setEntireState($boolean);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdministrator()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdministrator', array());

        return parent::getAdministrator();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdministrator($administrator)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdministrator', array($administrator));

        return parent::setAdministrator($administrator);
    }

    /**
     * {@inheritDoc}
     */
    public function getBudget()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getBudget', array());

        return parent::getBudget();
    }

    /**
     * {@inheritDoc}
     */
    public function setBudget($budget)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setBudget', array($budget));

        return parent::setBudget($budget);
    }

    /**
     * {@inheritDoc}
     */
    public function getCode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCode', array());

        return parent::getCode();
    }

    /**
     * {@inheritDoc}
     */
    public function setCode($code)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCode', array($code));

        return parent::setCode($code);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedTs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedTs', array());

        return parent::getCreatedTs();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedTs($createdTs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedTs', array($createdTs));

        return parent::setCreatedTs($createdTs);
    }

    /**
     * {@inheritDoc}
     */
    public function getDetails()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDetails', array());

        return parent::getDetails();
    }

    /**
     * {@inheritDoc}
     */
    public function hasDetail(\Application\Entity\Base\Program\DetailInterface $detail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasDetail', array($detail));

        return parent::hasDetail($detail);
    }

    /**
     * {@inheritDoc}
     */
    public function addDetail(\Application\Entity\Base\Program\DetailInterface $detail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addDetail', array($detail));

        return parent::addDetail($detail);
    }

    /**
     * {@inheritDoc}
     */
    public function removeDetail(\Application\Entity\Base\Program\DetailInterface $detail)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeDetail', array($detail));

        return parent::removeDetail($detail);
    }

    /**
     * {@inheritDoc}
     */
    public function getEndDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEndDate', array());

        return parent::getEndDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndDate($endDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEndDate', array($endDate));

        return parent::setEndDate($endDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getFundingSource()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFundingSource', array());

        return parent::getFundingSource();
    }

    /**
     * {@inheritDoc}
     */
    public function setFundingSource($fundingSource)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFundingSource', array($fundingSource));

        return parent::setFundingSource($fundingSource);
    }

    /**
     * {@inheritDoc}
     */
    public function getImplementingSector()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getImplementingSector', array());

        return parent::getImplementingSector();
    }

    /**
     * {@inheritDoc}
     */
    public function setImplementingSector(\Application\Entity\Base\ImplementingSectorInterface $implementingSector)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setImplementingSector', array($implementingSector));

        return parent::setImplementingSector($implementingSector);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getName', array());

        return parent::getName();
    }

    /**
     * {@inheritDoc}
     */
    public function setName($name)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setName', array($name));

        return parent::setName($name);
    }

    /**
     * {@inheritDoc}
     */
    public function getCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCategory', array());

        return parent::getCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function setCategory(\Application\Entity\Base\Program\CategoryInterface $programCategory)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCategory', array($programCategory));

        return parent::setCategory($programCategory);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', array());

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setType(\Application\Entity\Base\Program\TypeInterface $programType)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', array($programType));

        return parent::setType($programType);
    }

    /**
     * {@inheritDoc}
     */
    public function isPublished()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isPublished', array());

        return parent::isPublished();
    }

    /**
     * {@inheritDoc}
     */
    public function setPublished($published)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPublished', array($published));

        return parent::setPublished($published);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartDate()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStartDate', array());

        return parent::getStartDate();
    }

    /**
     * {@inheritDoc}
     */
    public function setStartDate($startDate)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStartDate', array($startDate));

        return parent::setStartDate($startDate);
    }

    /**
     * {@inheritDoc}
     */
    public function getStartDateText()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStartDateText', array());

        return parent::getStartDateText();
    }

    /**
     * {@inheritDoc}
     */
    public function setStartDateText($startDateText)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStartDateText', array($startDateText));

        return parent::setStartDateText($startDateText);
    }

    /**
     * {@inheritDoc}
     */
    public function getEndDateText()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getEndDateText', array());

        return parent::getEndDateText();
    }

    /**
     * {@inheritDoc}
     */
    public function setEndDateText($endDateText)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setEndDateText', array($endDateText));

        return parent::setEndDateText($endDateText);
    }

    /**
     * {@inheritDoc}
     */
    public function getState()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getState', array());

        return parent::getState();
    }

    /**
     * {@inheritDoc}
     */
    public function setState(\Application\Entity\Base\StateInterface $state)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setState', array($state));

        return parent::setState($state);
    }

    /**
     * {@inheritDoc}
     */
    public function getSummary()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSummary', array());

        return parent::getSummary();
    }

    /**
     * {@inheritDoc}
     */
    public function setAdditionalTechnologies($additionalTechnologies)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAdditionalTechnologies', array($additionalTechnologies));

        return parent::setAdditionalTechnologies($additionalTechnologies);
    }

    /**
     * {@inheritDoc}
     */
    public function getAdditionalTechnologies()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAdditionalTechnologies', array());

        return parent::getAdditionalTechnologies();
    }

    /**
     * {@inheritDoc}
     */
    public function setSummary($summary)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSummary', array($summary));

        return parent::setSummary($summary);
    }

    /**
     * {@inheritDoc}
     */
    public function getUpdatedTs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUpdatedTs', array());

        return parent::getUpdatedTs();
    }

    /**
     * {@inheritDoc}
     */
    public function setUpdatedTs($updatedTs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setUpdatedTs', array($updatedTs));

        return parent::setUpdatedTs($updatedTs);
    }

    /**
     * {@inheritDoc}
     */
    public function getWebsiteUrl()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getWebsiteUrl', array());

        return parent::getWebsiteUrl();
    }

    /**
     * {@inheritDoc}
     */
    public function setWebsiteUrl($websiteUrl)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setWebsiteUrl', array($websiteUrl));

        return parent::setWebsiteUrl($websiteUrl);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedByUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedByUser', array());

        return parent::getCreatedByUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedByUser(\Application\Entity\Base\UserInterface $createdByUser)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedByUser', array($createdByUser));

        return parent::setCreatedByUser($createdByUser);
    }

    /**
     * {@inheritDoc}
     */
    public function addTechnology(\Application\Entity\Base\TechnologyInterface $technology)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addTechnology', array($technology));

        return parent::addTechnology($technology);
    }

    /**
     * {@inheritDoc}
     */
    public function hasTechnology(\Application\Entity\Base\TechnologyInterface $technology)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasTechnology', array($technology));

        return parent::hasTechnology($technology);
    }

    /**
     * {@inheritDoc}
     */
    public function removeTechnology(\Application\Entity\Base\TechnologyInterface $technology)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeTechnology', array($technology));

        return parent::removeTechnology($technology);
    }

    /**
     * {@inheritDoc}
     */
    public function getTechnologies()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTechnologies', array());

        return parent::getTechnologies();
    }

    /**
     * {@inheritDoc}
     */
    public function getTechnologiesByEnergyCategory()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getTechnologiesByEnergyCategory', array());

        return parent::getTechnologiesByEnergyCategory();
    }

    /**
     * {@inheritDoc}
     */
    public function countTechnologies()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countTechnologies', array());

        return parent::countTechnologies();
    }

    /**
     * {@inheritDoc}
     */
    public function clearTechnologies()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearTechnologies', array());

        return parent::clearTechnologies();
    }

    /**
     * {@inheritDoc}
     */
    public function addCounty(\Application\Entity\Base\Program\CountyInterface $county)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCounty', array($county));

        return parent::addCounty($county);
    }

    /**
     * {@inheritDoc}
     */
    public function hasCounty(\Application\Entity\Base\Program\CountyInterface $county)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasCounty', array($county));

        return parent::hasCounty($county);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCounty(\Application\Entity\Base\Program\CountyInterface $county)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCounty', array($county));

        return parent::removeCounty($county);
    }

    /**
     * {@inheritDoc}
     */
    public function getCounties()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCounties', array());

        return parent::getCounties();
    }

    /**
     * {@inheritDoc}
     */
    public function countCounties()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countCounties', array());

        return parent::countCounties();
    }

    /**
     * {@inheritDoc}
     */
    public function addCity(\Application\Entity\Base\Program\CityInterface $city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addCity', array($city));

        return parent::addCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function hasCity(\Application\Entity\Base\Program\CityInterface $city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasCity', array($city));

        return parent::hasCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function removeCity(\Application\Entity\Base\Program\CityInterface $city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeCity', array($city));

        return parent::removeCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function getCities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCities', array());

        return parent::getCities();
    }

    /**
     * {@inheritDoc}
     */
    public function countCities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countCities', array());

        return parent::countCities();
    }

    /**
     * {@inheritDoc}
     */
    public function addUtility(\Application\Entity\Base\UtilityInterface $utility)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addUtility', array($utility));

        return parent::addUtility($utility);
    }

    /**
     * {@inheritDoc}
     */
    public function hasUtility(\Application\Entity\Base\UtilityInterface $utility)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasUtility', array($utility));

        return parent::hasUtility($utility);
    }

    /**
     * {@inheritDoc}
     */
    public function removeUtility(\Application\Entity\Base\UtilityInterface $utility)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeUtility', array($utility));

        return parent::removeUtility($utility);
    }

    /**
     * {@inheritDoc}
     */
    public function getUtilities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getUtilities', array());

        return parent::getUtilities();
    }

    /**
     * {@inheritDoc}
     */
    public function countUtilities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countUtilities', array());

        return parent::countUtilities();
    }

    /**
     * {@inheritDoc}
     */
    public function addZipCode(\Application\Entity\Base\Utility\ZipCodeInterface $zipcode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addZipCode', array($zipcode));

        return parent::addZipCode($zipcode);
    }

    /**
     * {@inheritDoc}
     */
    public function hasZipCode(\Application\Entity\Base\Utility\ZipCodeInterface $zipcode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasZipCode', array($zipcode));

        return parent::hasZipCode($zipcode);
    }

    /**
     * {@inheritDoc}
     */
    public function removeZipCode(\Application\Entity\Base\Utility\ZipCodeInterface $zipcode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeZipCode', array($zipcode));

        return parent::removeZipCode($zipcode);
    }

    /**
     * {@inheritDoc}
     */
    public function getZipCodes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getZipCodes', array());

        return parent::getZipCodes();
    }

    /**
     * {@inheritDoc}
     */
    public function countZipCodes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countZipCodes', array());

        return parent::countZipCodes();
    }

    /**
     * {@inheritDoc}
     */
    public function addAuthority(\Application\Entity\Base\Program\AuthorityInterface $authority)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addAuthority', array($authority));

        return parent::addAuthority($authority);
    }

    /**
     * {@inheritDoc}
     */
    public function hasAuthority(\Application\Entity\Base\Program\AuthorityInterface $authority)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasAuthority', array($authority));

        return parent::hasAuthority($authority);
    }

    /**
     * {@inheritDoc}
     */
    public function removeAuthority(\Application\Entity\Base\Program\AuthorityInterface $authority)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeAuthority', array($authority));

        return parent::removeAuthority($authority);
    }

    /**
     * {@inheritDoc}
     */
    public function getAuthorities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAuthorities', array());

        return parent::getAuthorities();
    }

    /**
     * {@inheritDoc}
     */
    public function countAuthorities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countAuthorities', array());

        return parent::countAuthorities();
    }

    /**
     * {@inheritDoc}
     */
    public function addParameterSet(\Application\Entity\Base\Parameter\SetInterface $paramSet)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addParameterSet', array($paramSet));

        return parent::addParameterSet($paramSet);
    }

    /**
     * {@inheritDoc}
     */
    public function hasParameterSet(\Application\Entity\Base\Parameter\SetInterface $paramSet)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasParameterSet', array($paramSet));

        return parent::hasParameterSet($paramSet);
    }

    /**
     * {@inheritDoc}
     */
    public function removeParameterSet(\Application\Entity\Base\Parameter\SetInterface $paramSet)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeParameterSet', array($paramSet));

        return parent::removeParameterSet($paramSet);
    }

    /**
     * {@inheritDoc}
     */
    public function getParameterSets()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getParameterSets', array());

        return parent::getParameterSets();
    }

    /**
     * {@inheritDoc}
     */
    public function countParameterSets()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countParameterSets', array());

        return parent::countParameterSets();
    }

    /**
     * {@inheritDoc}
     */
    public function addSubscriptionMemo(\Application\Entity\Base\Subscription\MemoInterface $subMemo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSubscriptionMemo', array($subMemo));

        return parent::addSubscriptionMemo($subMemo);
    }

    /**
     * {@inheritDoc}
     */
    public function hasSubscriptionMemo(\Application\Entity\Base\Subscription\MemoInterface $subMemo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasSubscriptionMemo', array($subMemo));

        return parent::hasSubscriptionMemo($subMemo);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSubscriptionMemo(\Application\Entity\Base\Subscription\MemoInterface $subMemo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSubscriptionMemo', array($subMemo));

        return parent::removeSubscriptionMemo($subMemo);
    }

    /**
     * {@inheritDoc}
     */
    public function getSubscriptionMemos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSubscriptionMemos', array());

        return parent::getSubscriptionMemos();
    }

    /**
     * {@inheritDoc}
     */
    public function countSubscriptionMemos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countSubscriptionMemos', array());

        return parent::countSubscriptionMemos();
    }

    /**
     * {@inheritDoc}
     */
    public function addProgramMemo(\Application\Entity\Base\Program\MemoInterface $programMemo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addProgramMemo', array($programMemo));

        return parent::addProgramMemo($programMemo);
    }

    /**
     * {@inheritDoc}
     */
    public function hasProgramMemo(\Application\Entity\Base\Program\MemoInterface $programMemo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasProgramMemo', array($programMemo));

        return parent::hasProgramMemo($programMemo);
    }

    /**
     * {@inheritDoc}
     */
    public function removeProgramMemo(\Application\Entity\Base\Program\MemoInterface $programMemo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeProgramMemo', array($programMemo));

        return parent::removeProgramMemo($programMemo);
    }

    /**
     * {@inheritDoc}
     */
    public function getProgramMemos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProgramMemos', array());

        return parent::getProgramMemos();
    }

    /**
     * {@inheritDoc}
     */
    public function countProgramMemos()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countProgramMemos', array());

        return parent::countProgramMemos();
    }

    /**
     * {@inheritDoc}
     */
    public function addSector(\Application\Entity\Base\Program\SectorInterface $sector)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSector', array($sector));

        return parent::addSector($sector);
    }

    /**
     * {@inheritDoc}
     */
    public function hasSector(\Application\Entity\Base\Program\SectorInterface $sector)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasSector', array($sector));

        return parent::hasSector($sector);
    }

    /**
     * {@inheritDoc}
     */
    public function removeSector(\Application\Entity\Base\Program\SectorInterface $sector)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeSector', array($sector));

        return parent::removeSector($sector);
    }

    /**
     * {@inheritDoc}
     */
    public function getSectors()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSectors', array());

        return parent::getSectors();
    }

    /**
     * {@inheritDoc}
     */
    public function countSectors()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countSectors', array());

        return parent::countSectors();
    }

    /**
     * {@inheritDoc}
     */
    public function clearSectors()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearSectors', array());

        return parent::clearSectors();
    }

    /**
     * {@inheritDoc}
     */
    public function addContact(\Application\Entity\Base\Program\ContactInterface $contact)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addContact', array($contact));

        return parent::addContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function hasContact(\Application\Entity\Base\Program\ContactInterface $contact)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'hasContact', array($contact));

        return parent::hasContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function removeContact(\Application\Entity\Base\Program\ContactInterface $contact)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'removeContact', array($contact));

        return parent::removeContact($contact);
    }

    /**
     * {@inheritDoc}
     */
    public function getContacts()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getContacts', array());

        return parent::getContacts();
    }

    /**
     * {@inheritDoc}
     */
    public function countContacts()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'countContacts', array());

        return parent::countContacts();
    }

    /**
     * {@inheritDoc}
     */
    public function clearCounties()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearCounties', array());

        return parent::clearCounties();
    }

    /**
     * {@inheritDoc}
     */
    public function clearCities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearCities', array());

        return parent::clearCities();
    }

    /**
     * {@inheritDoc}
     */
    public function clearZipCodes()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearZipCodes', array());

        return parent::clearZipCodes();
    }

    /**
     * {@inheritDoc}
     */
    public function clearAuthorities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearAuthorities', array());

        return parent::clearAuthorities();
    }

    /**
     * {@inheritDoc}
     */
    public function clearParameterSets()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearParameterSets', array());

        return parent::clearParameterSets();
    }

    /**
     * {@inheritDoc}
     */
    public function clearContacts()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearContacts', array());

        return parent::clearContacts();
    }

    /**
     * {@inheritDoc}
     */
    public function clearDetails()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearDetails', array());

        return parent::clearDetails();
    }

    /**
     * {@inheritDoc}
     */
    public function clearUtilities()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'clearUtilities', array());

        return parent::clearUtilities();
    }

    /**
     * {@inheritDoc}
     */
    public function flatten()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'flatten', array());

        return parent::flatten();
    }

    /**
     * {@inheritDoc}
     */
    public function addSelfTo(\Doctrine\Common\Collections\Collection $collection, $allowDuplicates = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSelfTo', array($collection, $allowDuplicates));

        return parent::addSelfTo($collection, $allowDuplicates);
    }

    /**
     * {@inheritDoc}
     */
    public function id()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'id', array());

        return parent::id();
    }

    /**
     * {@inheritDoc}
     */
    public function isNull()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isNull', array());

        return parent::isNull();
    }

    /**
     * {@inheritDoc}
     */
    public function flatCollection($collection, $extended = false, $indexById = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'flatCollection', array($collection, $extended, $indexById));

        return parent::flatCollection($collection, $extended, $indexById);
    }

    /**
     * {@inheritDoc}
     */
    public function asDoctrineProperty()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'asDoctrineProperty', array());

        return parent::asDoctrineProperty();
    }

    /**
     * {@inheritDoc}
     */
    public function nullGet(\FzyCommon\Entity\BaseInterface $entity = NULL, \FzyCommon\Entity\BaseNull $nullObject = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'nullGet', array($entity, $nullObject));

        return parent::nullGet($entity, $nullObject);
    }

    /**
     * {@inheritDoc}
     */
    public function tsSet($ts, $createIfEmpty = true, $timezone = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tsSet', array($ts, $createIfEmpty, $timezone));

        return parent::tsSet($ts, $createIfEmpty, $timezone);
    }

    /**
     * {@inheritDoc}
     */
    public function tsGet(\DateTime $tsProperty = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tsGet', array($tsProperty));

        return parent::tsGet($tsProperty);
    }

    /**
     * {@inheritDoc}
     */
    public function tsGetFormatted(\DateTime $tsProperty = NULL, $format = 'Y-m-d', $timezone = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tsGetFormatted', array($tsProperty, $format, $timezone));

        return parent::tsGetFormatted($tsProperty, $format, $timezone);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getFormTag()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFormTag', array());

        return parent::getFormTag();
    }

    /**
     * {@inheritDoc}
     */
    public function setFormTag($tag)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFormTag', array($tag));

        return parent::setFormTag($tag);
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'jsonSerialize', array());

        return parent::jsonSerialize();
    }

}
