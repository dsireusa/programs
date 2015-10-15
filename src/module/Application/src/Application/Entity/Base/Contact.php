<?php

namespace Application\Entity\Base;

use Doctrine\Common\Collections\ArrayCollection;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;
use Application\Entity\Base\Program\ContactInterface as ProgramContactInterface;

/**
 * Class Contact.
 *
 * @ORM\Entity
 * @ORM\Table(name="contact")
 * @Annotation\Options({
 *      "autorender": {
 *          "ngModel": "contact",
 *          "fieldsets": {
 *              {
 *                  "name": \FzyForm\Annotation\FieldSet::DEFAULT_NAME,
 *                  "legend": "Enter contact information"
 *              }
 *          }
 *      }
 * })
 */
class Contact extends Base implements ContactInterface
{
    /**
     * @ORM\Column(type="datetime", name="created_ts")
     * @Annotation\Exclude()
     *
     * @var \DateTime
     */
    protected $createdTs;

    /**
     * @ORM\Column(type="datetime", name="updated_ts")
     * @Annotation\Exclude()
     *
     * @var \DateTime
     */
    protected $updatedTs;

    /**
     * @ORM\Column(type="string", length=45, name="first_name")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving",
     *  "required": true
     * })
     * @Annotation\Options({
     *      "label":"First Name",
     *      "autorender": {
     *          "ngModel": "firstName"
     *      }})
     * @Annotation\ErrorMessage("Please provide a first name")
     *
     * @var string
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=45, name="last_name")
     *
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving",
     *  "required": true
     * })
     * @Annotation\Options({
     *      "label":"Last Name",
     *      "autorender": {
     *          "ngModel": "lastName"
     *      }})
     * @Annotation\ErrorMessage("Please provide a last name")
     *
     * @var string
     */
    protected $lastName;

    /**
     * @ORM\Column(type="string", length=45, name="organization_name")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving"
     * })
     * @Annotation\Options({
     *      "label":"Organization Name",
     *      "autorender": {
     *          "ngModel": "organizationName"
     *      }})
     * @Annotation\ErrorMessage("Please provide an organization name")
     * @Annotation\AllowEmpty()
     *
     * @var string
     */
    protected $organizationName;

    /**
     * @ORM\Column(type="boolean", nullable=false, options={"default":1}, name="web_visible_default")
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Attributes({"data-ng-disabled": "saving"})
     * @Annotation\Options({
     *      "label": "Web Visible by default",
     *      "autorender": {
     *          "ngModel": "webVisibleDefault"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\Filter({"name": "Boolean", "options": {"type": \Zend\Filter\Boolean::TYPE_ALL}})
     *
     * @var bool
     */
    protected $webVisibleDefault;

    /**
     * @ORM\Column(type="string", length=45)
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving"
     * })
     * @Annotation\Options({
     *      "label":"Phone",
     *      "autorender": {
     *          "ngModel": "phone"
     *      }})
     * @Annotation\ErrorMessage("Please provide a phone number")
     * @Annotation\AllowEmpty()
     *
     * @var string
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=255)
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving"
     * })
     * @Annotation\Options({
     *      "label":"Email",
     *      "autorender": {
     *          "ngModel": "email"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\Validator({"name": "EmailAddress"})
     * @Annotation\ErrorMessage("Please provide an email")
     *
     * @var string
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255, name="website_url")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving"
     * })
     * @Annotation\Options({
     *      "label":"Website URL",
     *      "autorender": {
     *          "ngModel": "websiteUrl"
     *      }})
     * @Annotation\ErrorMessage("Please provide a valid website URL")
     * @Annotation\AllowEmpty()
     *
     * @var string
     */
    protected $websiteUrl;

    /**
     * @ORM\Column(type="string", length=255)
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving"
     * })
     * @Annotation\Options({
     *      "label":"Address",
     *      "autorender": {
     *          "ngModel": "address"
     *      }})
     * @Annotation\ErrorMessage("Please provide a mailing address")
     * @Annotation\AllowEmpty()
     *
     * @var string
     */
    protected $address;

    /**
     * @ORM\Column(type="string", length=255)
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving"
     * })
     * @Annotation\Options({
     *      "label":"City",
     *      "autorender": {
     *          "ngModel": "city"
     *      }})
     * @Annotation\ErrorMessage("Please provide a city")
     * @Annotation\AllowEmpty()
     *
     * @var string
     */
    protected $city;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\State")
     * @ORM\JoinColumn(name="state_id", referencedColumnName="id")
     * @Annotation\Type("Zend\Form\Element\Hidden")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label":"State",
     *      "autorender": {
     *          "ngModel": "state",
     *          "selectOptions": "stateOptions",
     *          "type": "select"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please select a valid state")
     *
     * @var StateInterface
     */
    protected $state;

    /**
     * @ORM\Column(type="string", length=255)
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({
     *  "data-ng-disabled": "saving"
     * })
     * @Annotation\Options({
     *      "label":"Zip Code",
     *      "autorender": {
     *          "ngModel": "zip"
     *      }})
     * @Annotation\ErrorMessage("Please provide a zip code")
     * @Annotation\AllowEmpty()
     * @Annotation\Validator({"name": "Regex", "options": {"pattern": "/^\d{5}(-\d{4})?$/"}})
     *
     * @var string
     */
    protected $zip;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program\Contact", mappedBy="contact")
     *
     * @var Collection
     */
    protected $programContacts;

    public function __construct()
    {
        parent::__construct();
        $this->programContacts = new ArrayCollection();
        $this->webVisibleDefault = false;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return $this->createdTs;
    }

    /**
     * @param \DateTime $createTs
     *
     * @return $this
     */
    public function setCreatedTs($createdTs)
    {
        $this->createdTs = $createdTs;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return string
     */
    public function getOrganizationName()
    {
        return $this->organizationName;
    }

    /**
     * @param string $organizationName
     *
     * @return $this
     */
    public function setOrganizationName($organizationName)
    {
        $this->organizationName = $organizationName;

        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

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
     * @return \DateTime
     */
    public function getUpdatedTs()
    {
        return $this->updatedTs;
    }

    /**
     * @param \DateTime $updatedTs
     *
     * @return $this
     */
    public function setUpdatedTs($updatedTs)
    {
        $this->updatedTs = $updatedTs;

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
     * @return string
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param string $zip
     *
     * @return $this
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * @return bool
     */
    public function isWebVisibleDefault()
    {
        return $this->webVisibleDefault;
    }

    /**
     * @param bool $webVisibleDefault
     *
     * @return $this
     */
    public function setWebVisibleDefault($webVisibleDefault = true)
    {
        $this->webVisibleDefault = $webVisibleDefault;

        return $this;
    }

    /**
     * @param ProgramContactInterface $program
     *
     * @return $this
     */
    public function addProgramContact(ProgramContactInterface $program)
    {
        $program->addSelfTo($this->programContacts);

        return $this;
    }

    /**
     * @param ProgramContactInterface $program
     *
     * @return bool
     */
    public function hasProgramContact(ProgramContactInterface $program)
    {
        return $this->programContacts->contains($program);
    }

    /**
     * @param ProgramContactInterface $program
     *
     * @return $this
     */
    public function removeProgramContact(ProgramContactInterface $program)
    {
        $this->programContacts->removeElement($program);

        return $this;
    }

    /**
     * @return array
     */
    public function getProgramContacts()
    {
        return $this->programContacts->toArray();
    }

    /**
     * @return int
     */
    public function countProgramContacts()
    {
        return $this->programContacts->count();
    }

    /**
     * @return $this
     */
    public function clearProgramContacts()
    {
        $this->programContacts = new ArrayCollection();

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'email' => $this->getEmail(),
            'phone' => $this->formatPhoneNumber($this->getPhone()),
            'organizationName' => $this->getOrganizationName(),
            'webVisibleDefault' => $this->isWebVisibleDefault(),
            'websiteUrl' => $this->getWebsiteUrl(),
            'address' => $this->getAddress(),
            'city' => $this->getCity(),
            'state' => $this->getState()->id(),
            'stateObject' => $this->getState()->flatten(),
            'zip' => $this->getZip(),
        ));
    }

    protected function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        if (strlen($phoneNumber) > 10) {
            $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
            $areaCode = substr($phoneNumber, -10, 3);
            $nextThree = substr($phoneNumber, -7, 3);
            $lastFour = substr($phoneNumber, -4, 4);

            $phoneNumber = '+'.$countryCode.' ('.$areaCode.') '.$nextThree.'-'.$lastFour;
        } elseif (strlen($phoneNumber) == 10) {
            $areaCode = substr($phoneNumber, 0, 3);
            $nextThree = substr($phoneNumber, 3, 3);
            $lastFour = substr($phoneNumber, 6, 4);

            $phoneNumber = '('.$areaCode.') '.$nextThree.'-'.$lastFour;
        } elseif (strlen($phoneNumber) == 7) {
            $nextThree = substr($phoneNumber, 0, 3);
            $lastFour = substr($phoneNumber, 3, 4);

            $phoneNumber = $nextThree.'-'.$lastFour;
        }

        return $phoneNumber;
    }
}
