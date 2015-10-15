<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Parameter\SetInterface;
use Application\Entity\Base\Program\CategoryInterface;
use Application\Entity\Base\Program\CategoryNull;
use Application\Entity\Base\Program\CityInterface;
use Application\Entity\Base\Program\DetailInterface;
use Application\Entity\Base\Program\CountyInterface as ProgramCountyInterface;
use Application\Entity\Base\Program\MemoInterface as ProgramMemoInterface;
use Application\Entity\Base\Program\TypeInterface;
use Application\Entity\Base\Program\SectorInterface;
use Application\Entity\Base\Program\TypeNull;
use Application\Entity\Base\Subscription\MemoInterface as SubscriptionMemoInterface;
use Application\Entity\Base\Utility\ZipCodeInterface;
use Application\Entity\Base\Program\AuthorityInterface as ProgramAuthorityInterface;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Application\Entity\Base\Program\ContactInterface as ProgramContactInterface;

/**
 * Class Program.
 *
 * @ORM\Entity
 * @ORM\Table(name="program")
 * @Annotation\Options({
 *      "autorender": {
 *          "ngModel": "program",
 *          "suppressDenotesText": true,
 *          "fieldsets": {
 *              {
 *                  "name": \FzyForm\Annotation\FieldSet::DEFAULT_NAME,
 *                  "legend": "Program Information",
 *                  "template": "partials/form/program/information",
 *                  "rows": {
 *                      {"name": "name"},
 *                      {"name": "website"},
 *                      {"name": "administrator"},
 *                      {"name": "funding"},
 *                      {"name": "budget"},
 *                      {"name": "start", "cssClass": "field date-range"},
 *                      {"name": "expiration", "cssClass": "field date-range"},
 *                      {"name": "summary"},
 *                  }
 *              },
 *              {
 *                  "name": "coverage",
 *                  "legend": "Coverage Area",
 *                  "template": "partials/form/program/coverage"
 *              },
 *              {
 *                  "name": "technology",
 *                  "legend": "Eligible Technology",
 *                  "template": "partials/form/program/technology"
 *              },
 *              {
 *                  "name": "sector",
 *                  "legend": "Eligible Sectors",
 *                  "template": "partials/form/program/sector"
 *              },
 *              {
 *                  "name": "parameter",
 *                  "legend": "Machine Readable Combinations and Parameters",
 *                  "template": "partials/form/program/parameters"
 *              },
 *              {
 *                  "name": "detail",
 *                  "legend": "Details",
 *                  "template": "partials/form/program/detail"
 *              },
 *              {
 *                  "name": "authority",
 *                  "legend": "Authority",
 *                  "template": "partials/form/program/authority"
 *              },
 *              {
 *                  "name": "contact",
 *                  "legend": "Contacts",
 *                  "template": "partials/form/program/contact"
 *              },
 *              {
 *                  "name": "memo",
 *                  "legend": "Memo and History",
 *                  "rows": {
 *                      {"name": "internal"},
 *                      {"name": "subscription"}
 *                  }
 *              }
 *          }
 *      }
 * })
 */
class Program extends Base implements ProgramInterface
{
    /**
     * @ORM\Column(type="string", length=255, name="name")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"required": true})
     * @Annotation\Options({
     *      "label": "Program Name",
     *      "autorender": {
     *          "ngModel": "name",
     *          "row": "name"
     *      }
     * })
     * @Annotation\Required(true)
     * @Annotation\ErrorMessage("Please specify a program name.")
     *
     * @var string
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=255, name="websiteurl")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Website",
     *      "autorender": {
     *          "ngModel": "websiteUrl",
     *          "row": "website"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\Filter({"name": "StringTrim"})
     * @Annotation\Validator({"name": "Uri", "options": {"allowRelative": false}})
     * @Annotation\ErrorMessage("Please specify a website url.")
     *
     * @var string
     */
    protected $websiteUrl;

    /**
     * @ORM\Column(type="string", length=255, name="administrator")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Administrator",
     *      "autorender": {
     *          "ngModel": "admin",
     *          "row": "administrator"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a program administrator.")
     *
     * @var string
     */
    protected $administrator;

    /**
     * @ORM\Column(type="string", length=255, name="fundingsource")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Funding Source",
     *      "autorender": {
     *          "ngModel": "fundingSource",
     *          "row": "funding"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a program funding source.")
     *
     * @var string
     */
    protected $fundingSource;

    /**
     * @ORM\Column(type="string", length=255, name="budget")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Budget",
     *      "autorender": {
     *          "ngModel": "budget",
     *          "row": "budget"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a program budget.")
     *
     * @var string
     */
    protected $budget;

    /**
     * @ORM\Column(type="datetime", name="start_date")
     * @Annotation\Type("Zend\Form\Element\DateTime")
     * @Annotation\Attributes({
     *  "data-ui-date": "dateOptions",
     *  "data-ui-date-format": "yy-mm-dd"
     * })
     * @Annotation\Options({
     *      "label": "Start Date",
     *      "autorender": {
     *          "ngModel": "startDate",
     *          "row": "start"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a program start date.")
     *
     * @var \DateTime
     */
    protected $startDate;

    /**
     * @ORM\Column(type="text", length=255, name="start_date_text")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *      "name": "startDateText"
     * })
     * @Annotation\Options({
     *      "autorender": {
     *          "ngModel": "startDateText",
     *          "row": "start",
     *          "noLabel": true,
     *          "inputTemplate": "partials/form/hidden-input"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Invalid start date custom text")
     *
     * @var string
     */
    protected $startDateText;

    /**
     * @ORM\Column(type="datetime", name="end_date")
     * @Annotation\Type("Zend\Form\Element\DateTime")
     * @Annotation\Attributes({
     *  "data-ui-date": "dateOptions",
     *  "data-ui-date-format": "yy-mm-dd"
     * })
     * @Annotation\Options({
     *      "label": "Expiration Date",
     *      "autorender": {
     *          "ngModel": "endDate",
     *          "row": "expiration"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a program end date.")
     *
     * @var \DateTime
     */
    protected $endDate;

    /**
     * @ORM\Column(type="text", length=255, name="end_date_text")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *      "name": "endDateText"
     * })
     * @Annotation\Options({
     *      "label": "End Date (Legacy)",
     *      "autorender": {
     *          "ngModel": "endDateText",
     *          "row": "expiration",
     *          "noLabel": true,
     *          "inputTemplate": "partials/form/hidden-input"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Invalid end date custom text")
     *
     * @var string
     */
    protected $endDateText;

    /**
     * @ORM\Column(type="text", name="summary")
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Summary",
     *      "autorender": {
     *          "ngModel": "summary",
     *          "type": "wysiwyg",
     *          "row": "summary"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a program summary.")
     *
     * @var string
     */
    protected $summary;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\Attributes({"required": true})
     * @Annotation\ErrorMessage("Please specify a state for this program.")
     *
     * @var StateInterface
     */
    protected $state;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": false}, name="is_entire_state")
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Attributes({"data-ng-disabled": "saving"})
     * @Annotation\Options({
     *      "label": "Incentive applies to entire state",
     *      "autorender": {
     *          "ngModel": "entireState"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\Filter({"name": "Boolean", "options": {"type": \Zend\Filter\Boolean::TYPE_ALL}})
     *
     * @var bool
     */
    protected $entireState;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\User")
     * @ORM\JoinColumn(name="created_by_user_id", referencedColumnName="id")
     * @Annotation\Exclude()
     *
     * @var UserInterface
     */
    protected $createdByUser;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\ImplementingSector", inversedBy="programs")
     * @ORM\JoinColumn(name="implementing_sector_id", referencedColumnName="id")
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\Attributes({"required": true})
     * @Annotation\Options({
     *      "label":"Implementing Sector",
     *      })
     *
     * @var ImplementingSectorInterface
     */
    protected $implementingSector;

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
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program\Type")
     * @ORM\JoinColumn(name="program_type_id", referencedColumnName="id")
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\Attributes({"required": true})
     * @Annotation\Options({
     *      "label":"Program Type",
     *      })
     *
     * @var TypeInterface
     */
    protected $type;

    /**
     * @ORM\Column(type="string", length=45, name="code")
     *
     * @var string
     */
    protected $code;

    /**
     * @ORM\Column(type="datetime", name="updated_ts")
     *
     * @var \DateTime
     */
    protected $updatedTs;

    /**
     * @ORM\Column(type="datetime", name="created_ts")
     *
     * @var \DateTime
     */
    protected $createdTs;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default": false}, name="published")
     *
     * @var bool
     */
    protected $published;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program\County", inversedBy="programs")
     * @ORM\JoinTable(name="program_county")
     *
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $counties;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program\City", inversedBy="programs")
     * @ORM\JoinTable(name="program_city")
     *
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $cities;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Utility", inversedBy="programs")
     * @ORM\JoinTable(name="program_utility")
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $utilities;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Utility\ZipCode", inversedBy="programs")
     * @ORM\JoinTable(name="program_zipcode")
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $zipCodes;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program\Contact", mappedBy="program", orphanRemoval=true)
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $contacts;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Parameter\Set", mappedBy="program", orphanRemoval=true)
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $parameterSets;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program\Detail", mappedBy="program")
     * @ORM\OrderBy({"displayOrder" = "ASC"})
     * @Annotation\Exclude()
     *
     * @var Collection
     */
    protected $details;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program\Authority", mappedBy="program", cascade={"persist", "remove"}, orphanRemoval=true)
     *
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $authorities;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Program\Sector", inversedBy="program")
     * @ORM\JoinTable(name="program_sector")
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $sectors;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program\Memo", mappedBy="program")
     * @ORM\OrderBy({"dateAdded" = "DESC"})
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Internal Memo",
     *      "autorender": {
     *          "ngModel": "newProgramMemo",
     *          "type": "wysiwyg",
     *          "row": "internal",
     *          "template": "partials/form/program/memo/input",
     *          "openText": "Internal Memo History",
     *          "heading": "Internal Memo",
     *          "memoType": "program"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a valid internal memo.")
     *
     * @var ArrayCollection
     */
    protected $programMemos;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Subscription\Memo", mappedBy="program")
     * @ORM\OrderBy({"dateAdded" = "DESC"})
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Subscription Memo",
     *      "autorender": {
     *          "ngModel": "newSubscriptionMemo",
     *          "type": "wysiwyg",
     *          "row": "subscription",
     *          "template": "partials/form/program/memo/input",
     *          "openText": "News and Email Subscription Memo History",
     *          "heading": "Subscription Memo",
     *          "memoType": "subscription"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify a valid subscription memo.")
     *
     * @var ArrayCollection
     */
    protected $subscriptionMemos;

    /**
     * @ORM\ManyToMany(targetEntity="Application\Entity\Base\Technology", inversedBy="programs")
     * @ORM\JoinTable(name="program_technology")
     * @Annotation\Exclude()
     *
     * @var ArrayCollection
     */
    protected $technologies;

    /**
     * @ORM\Column(type="text", name="additional_technologies")
     * @Annotation\Type("Zend\Form\Element\Textarea")
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify additional Technologies.")
     *
     * @var string
     */
    protected $additionalTechnologies;

    public function __construct()
    {
        parent::__construct();
        $this->authorities = new ArrayCollection();
        $this->counties = new ArrayCollection();
        $this->cities = new ArrayCollection();
        $this->utilities = new ArrayCollection();
        $this->contacts = new ArrayCollection();
        $this->parameterSets = new ArrayCollection();
        $this->sectors = new ArrayCollection();
        $this->subscriptionMemos = new ArrayCollection();
        $this->programMemos = new ArrayCollection();
        $this->technologies = new ArrayCollection();
        $this->details = new ArrayCollection();
        $this->zipCodes = new ArrayCollection();
        $this->entireState = false;
        $this->published = false;
    }

    /**
     * @return bool
     */
    public function isEntireState()
    {
        return $this->entireState;
    }

    /**
     * @param bool $boolean
     *
     * @return $this
     */
    public function setEntireState($boolean = true)
    {
        $this->entireState = $boolean;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdministrator()
    {
        return $this->administrator;
    }

    /**
     * @param string $administrator
     *
     * @return $this
     */
    public function setAdministrator($administrator)
    {
        $this->administrator = $administrator;

        return $this;
    }

    /**
     * @return string
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * @param string $budget
     *
     * @return $this
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return $this->tsGet($this->createdTs);
    }

    /**
     * @param mixed $createdTs
     *
     * @return $this
     */
    public function setCreatedTs($createdTs)
    {
        $this->createdTs = $this->tsSet($createdTs);

        return $this;
    }

    /**
     * @return array
     */
    public function getDetails()
    {
        return $this->details->toArray();
    }

    /**
     * @param DetailInterface $detail
     *
     * @return bool
     */
    public function hasDetail(DetailInterface $detail)
    {
        return $this->details->contains($detail);
    }

    /**
     * @param DetailInterface $detail
     *
     * @return $this
     */
    public function addDetail(DetailInterface $detail)
    {
        $detail->addSelfTo($this->details);

        return $this;
    }

    /**
     * @param DetailInterface $detail
     *
     * @return $this
     */
    public function removeDetail(DetailInterface $detail)
    {
        $this->details->removeElement($detail);

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * @param mixed $endDate
     *
     * @return $this
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getFundingSource()
    {
        return $this->fundingSource;
    }

    /**
     * @param string $fundingSource
     *
     * @return $this
     */
    public function setFundingSource($fundingSource)
    {
        $this->fundingSource = $fundingSource;

        return $this;
    }

    /**
     * @return ImplementingSectorInterface
     */
    public function getImplementingSector()
    {
        return $this->nullGet($this->implementingSector, new ImplementingSectorNull());
    }

    /**
     * @param ImplementingSectorInterface $implementingSector
     *
     * @return $this
     */
    public function setImplementingSector(ImplementingSectorInterface $implementingSector)
    {
        $this->implementingSector = $implementingSector->asDoctrineProperty();

        return $this;
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
     * @return CategoryInterface;
     */
    public function getCategory()
    {
        return $this->nullGet($this->category, new CategoryNull());
    }

    /**
     * @param CategoryInterface $programCategory
     *
     * @return $this
     */
    public function setCategory(CategoryInterface $programCategory)
    {
        $this->category = $programCategory->asDoctrineProperty();

        return $this;
    }

    /**
     * @return TypeInterface
     */
    public function getType()
    {
        return $this->nullGet($this->type, new TypeNull());
    }

    /**
     * @param TypeInterface $programType
     *
     * @return $this
     */
    public function setType(TypeInterface $programType)
    {
        $this->type = $programType->asDoctrineProperty();

        return $this;
    }

    /**
     * @return bool
     */
    public function isPublished()
    {
        return $this->published;
    }

    /**
     * @param bool $published
     *
     * @return $this;
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     *
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * @return string
     */
    public function getStartDateText()
    {
        return $this->startDateText;
    }

    /**
     * @param string $startDateText
     *
     * @return $this
     */
    public function setStartDateText($startDateText)
    {
        $this->startDateText = $startDateText;

        return $this;
    }

    /**
     * @return string
     */
    public function getEndDateText()
    {
        return $this->endDateText;
    }

    /**
     * @param string $endDateText
     *
     * @return $this
     */
    public function setEndDateText($endDateText)
    {
        $this->endDateText = $endDateText;

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
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param string $additionalTechnologies
     *
     * @return $this
     */
    public function setAdditionalTechnologies($additionalTechnologies)
    {
        $this->additionalTechnologies = $additionalTechnologies;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdditionalTechnologies()
    {
        return $this->additionalTechnologies;
    }

    /**
     * @param string $summary
     *
     * @return $this
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedTs()
    {
        return $this->tsGet($this->updatedTs);
    }

    /**
     * @param mixed $updatedTs
     *
     * @return $this
     */
    public function setUpdatedTs($updatedTs)
    {
        $this->updatedTs = $this->tsSet($updatedTs);

        return $this;
    }

    /**
     * @return string
     */
    public function getWebsiteUrl()
    {
        return $this->websiteUrl;
    }

    /**
     * @param string $websiteUrl
     *
     * @return $this
     */
    public function setWebsiteUrl($websiteUrl)
    {
        $this->websiteUrl = $websiteUrl;

        return $this;
    }

    /**
     * @return UserInterface
     */
    public function getCreatedByUser()
    {
        return $this->nullGet($this->createdByUser, new UserNull());
    }

    /**
     * @param UserInterface $createdByUser
     *
     * @return $this
     */
    public function setCreatedByUser(UserInterface $createdByUser)
    {
        $this->createdByUser = $createdByUser->asDoctrineProperty();

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

    public function getTechnologiesByEnergyCategory()
    {
        $technologiesByEnergyCategory = array();
        foreach ($this->technologies as $technology) {
            if ($technology->isActive()) {
                $energyCategoryId = $technology->getCategory()->getEnergyCategory()->id();
                if (!array_key_exists($energyCategoryId, $technologiesByEnergyCategory)) {
                    $technologiesByEnergyCategory[$energyCategoryId] = array();
                }
                $technologiesByEnergyCategory[$energyCategoryId][] = $technology;
            }
        };

        return $technologiesByEnergyCategory;
    }

    /**
     * @return int
     */
    public function countTechnologies()
    {
        return $this->technologies->count();
    }

    /**
     * Removes all technologies.
     *
     * @return $this
     */
    public function clearTechnologies()
    {
        return $this->clearCollection($this->technologies);
    }

    /**
     * @param ProgramCountyInterface $county
     *
     * @return $this
     */
    public function addCounty(ProgramCountyInterface $county)
    {
        $county->addSelfTo($this->counties);

        return $this;
    }

    /**
     * @param ProgramCountyInterface $county
     *
     * @return bool
     */
    public function hasCounty(ProgramCountyInterface $county)
    {
        return $this->counties->contains($county);
    }

    /**
     * @param ProgramCountyInterface $county
     *
     * @return $this
     */
    public function removeCounty(ProgramCountyInterface $county)
    {
        $this->counties->removeElement($county);

        return $this;
    }

    /**
     * @return array
     */
    public function getCounties()
    {
        return $this->counties->toArray();
    }

    /**
     * @return int
     */
    public function countCounties()
    {
        return $this->counties->count();
    }

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function addCity(CityInterface $city)
    {
        $city->addSelfTo($this->cities);

        return $this;
    }

    /**
     * @param CityInterface $city
     *
     * @return bool
     */
    public function hasCity(CityInterface $city)
    {
        return $this->cities->contains($city);
    }

    /**
     * @param CityInterface $city
     *
     * @return $this
     */
    public function removeCity(CityInterface $city)
    {
        $this->cities->removeElement($city);

        return $this;
    }

    /**
     * @return array
     */
    public function getCities()
    {
        return $this->cities->toArray();
    }

    /**
     * @return int
     */
    public function countCities()
    {
        return $this->cities->count();
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
     * @param ZipCodeInterface $zipcode
     *
     * @return $this
     */
    public function addZipCode(ZipCodeInterface $zipcode)
    {
        $zipcode->addSelfTo($this->zipCodes);

        return $this;
    }

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return bool
     */
    public function hasZipCode(ZipCodeInterface $zipcode)
    {
        return $this->zipCodes->contains($zipcode);
    }

    /**
     * @param ZipCodeInterface $zipcode
     *
     * @return $this
     */
    public function removeZipCode(ZipCodeInterface $zipcode)
    {
        $this->zipCodes->removeElement($zipcode);

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

    /**
     * @param ProgramAuthorityInterface $authority
     *
     * @return $this
     */
    public function addAuthority(ProgramAuthorityInterface $authority)
    {
        $authority->addSelfTo($this->authorities);

        return $this;
    }

    /**
     * @param ProgramAuthorityInterface $authority
     *
     * @return bool
     */
    public function hasAuthority(ProgramAuthorityInterface $authority)
    {
        return $this->authorities->contains($authority);
    }

    /**
     * @param ProgramAuthorityInterface $authority
     *
     * @return $this
     */
    public function removeAuthority(ProgramAuthorityInterface $authority)
    {
        $this->authorities->removeElement($authority);

        return $this;
    }

    /**
     * @return array
     */
    public function getAuthorities()
    {
        return $this->authorities->toArray();
    }

    /**
     * @return int
     */
    public function countAuthorities()
    {
        return $this->authorities->count();
    }

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function addParameterSet(SetInterface $paramSet)
    {
        $paramSet->addSelfTo($this->parameterSets);

        return $this;
    }

    /**
     * @param SetInterface $paramSet
     *
     * @return bool
     */
    public function hasParameterSet(SetInterface $paramSet)
    {
        return $this->parameterSets->contains($paramSet);
    }

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function removeParameterSet(SetInterface $paramSet)
    {
        $this->parameterSets->removeElement($paramSet);

        return $this;
    }

    /**
     * @return array
     */
    public function getParameterSets()
    {
        return $this->parameterSets->toArray();
    }

    /**
     * @return int
     */
    public function countParameterSets()
    {
        return $this->parameterSets->count();
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function addSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        $subMemo->addSelfTo($this->subscriptionMemos);

        return $this;
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return bool
     */
    public function hasSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return $this->subscriptionMemos->contains($subMemo);
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function removeSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        $this->subscriptionMemos->removeElement($subMemo);

        return $this;
    }

    /**
     * @return array
     */
    public function getSubscriptionMemos()
    {
        return $this->subscriptionMemos->toArray();
    }

    /**
     * @return int
     */
    public function countSubscriptionMemos()
    {
        return $this->subscriptionMemos->count();
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function addProgramMemo(ProgramMemoInterface $programMemo)
    {
        $programMemo->addSelfTo($this->programMemos);

        return $this;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return bool
     */
    public function hasProgramMemo(ProgramMemoInterface $programMemo)
    {
        return $this->programMemos->contains($programMemo);
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function removeProgramMemo(ProgramMemoInterface $programMemo)
    {
        $this->programMemos->removeElement($programMemo);

        return $this;
    }

    /**
     * @return array
     */
    public function getProgramMemos()
    {
        return $this->programMemos->toArray();
    }

    /**
     * @return int
     */
    public function countProgramMemos()
    {
        return $this->programMemos->count();
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
     * @param ProgramContactInterface $contact
     *
     * @return $this
     */
    public function addContact(ProgramContactInterface $contact)
    {
        $contact->addSelfTo($this->contacts);

        return $this;
    }

    /**
     * @param ProgramContactInterface $contact
     *
     * @return bool
     */
    public function hasContact(ProgramContactInterface $contact)
    {
        return $this->contacts->contains($contact);
    }

    /**
     * @param ProgramContactInterface $contact
     *
     * @return $this
     */
    public function removeContact(ProgramContactInterface $contact)
    {
        $this->contacts->removeElement($contact);

        return $this;
    }

    /**
     * @return array
     */
    public function getContacts()
    {
        return $this->contacts->toArray();
    }

    /**
     * @return int
     */
    public function countContacts()
    {
        return $this->contacts->count();
    }

    /**
     * Removes all counties.
     *
     * @return $this
     */
    public function clearCounties()
    {
        return $this->clearCollection($this->counties);
    }

    /**
     * Removes all cities.
     *
     * @return $this
     */
    public function clearCities()
    {
        return $this->clearCollection($this->cities);
    }

    /**
     * Removes all zipcodes.
     *
     * @return $this
     */
    public function clearZipCodes()
    {
        return $this->clearCollection($this->zipCodes);
    }

    /**
     * Removes all authorities.
     *
     * @return $this
     */
    public function clearAuthorities()
    {
        return $this->clearCollection($this->authorities);
    }

    /**
     * Removes all parameter sets.
     *
     * @return $this
     */
    public function clearParameterSets()
    {
        return $this->clearCollection($this->parameterSets);
    }

    /**
     * Removes all program contact relations.
     *
     * @return $this
     */
    public function clearContacts()
    {
        return $this->clearCollection($this->contacts);
    }

    /**
     * @return $this
     */
    public function clearDetails()
    {
        return $this->clearCollection($this->details);
    }

    /**
     * @return $this
     */
    public function clearUtilities()
    {
        return $this->clearCollection($this->utilities);
    }

    /**
     * Handles common behavior for detatching entire collection set from this program entity.
     * Expects the collection to contain a set of classes which implement HasProgramInterface.
     *
     * @param Collection $collection
     *
     * @return $this
     */
    protected function clearCollection(Collection $collection)
    {
        $null = new ProgramNull();
        foreach ($collection as $entity) {
            if ($entity instanceof \Application\Entity\Base\HasProgramInterface) {
                $entity->setProgram($null);
            } elseif ($entity instanceof \Application\Entity\Base\HasMultiProgramInterface) {
                $entity->removeProgram($this);
            }
        }
        // shouldn't be anything to clear, but just in case
        $collection->clear();

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            // immutable fields
            'entireState' => $this->isEntireState(),
            'state' => $this->getState()->id(),
            'stateObj' => $this->getState()->flatten(),
            'type' => $this->getType()->id(),
            'typeObj' => $this->getType()->flatten(),
            'category' => $this->getCategory()->id(),
            'categoryObj' => $this->getCategory()->flatten(),
            'sector' => $this->getImplementingSector()->id(),
            'sectorObj' => $this->getImplementingSector()->flatten(),
            'code' => $this->getCode(),
            // info
            'name' => $this->getName(),
            'websiteUrl' => $this->getWebsiteUrl(),
            'admin' => $this->getAdministrator(),
            'fundingSource' => $this->getFundingSource(),
            'budget' => $this->getBudget(),
            'startDate' => $this->tsGetFormatted($this->getStartDate()),
            'startDateDisplay' => $this->getStartDate() ? $this->tsGetFormatted($this->getStartDate(), 'm/d/Y') : $this->startDateText,
            'startDateText' => $this->startDateText,
            'endDate' => $this->tsGetFormatted($this->getEndDate()),
            'endDateDisplay' => $this->getEndDate() ? $this->tsGetFormatted($this->getEndDate(), 'm/d/Y') : $this->endDateText,
            'endDateText' => $this->endDateText,

            'summary' => $this->getSummary(),

            'published' => $this->isPublished(),

            'parameterSets' => $this->flatCollection($this->parameterSets, true),

            'updatedTs' => $this->tsGetFormatted($this->updatedTs, 'm/d/Y'),
            // formatted version for the update screen
            'lastUpdated' => $this->tsGetFormatted($this->updatedTs, 'F j, Y'),
            'createdTs' => $this->tsGetFormatted($this->createdTs, 'm/d/Y'),

            'additionalTechnologies' => $this->getAdditionalTechnologies(),
        ));
    }
}
