<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Program\ContactInterface as ProgramContact;
use FzyCommon\Entity\BaseNull;

class ContactNull extends BaseNull implements ContactInterface
{
    /**
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return new \DateTime();
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
     * @return \DateTime
     */
    public function getUpdatedTs()
    {
        return new \DateTime();
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
     * @return string
     */
    public function getFirstName()
    {
        return;
    }

    /**
     * @param $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return;
    }

    /**
     * @param $lastName
     *
     * @return $this
     */
    public function setLastName($lastName)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getOrganizationName()
    {
        return;
    }

    /**
     * @param $orgName
     *
     * @return $this
     */
    public function setOrganizationName($orgName)
    {
        return $this;
    }

    /**
     * @return bool
     */
    public function isWebVisibleDefault()
    {
        return false;
    }

    /**
     * @param bool $isWebVisible
     *
     * @return $this
     */
    public function setWebVisibleDefault($isWebVisible = true)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return;
    }

    /**
     * @param $phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return;
    }

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email)
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
     * @param $websiteUrl
     *
     * @return $this
     */
    public function setWebsiteUrl($websiteUrl)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return;
    }

    /**
     * @param $address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return;
    }

    /**
     * @param $city
     *
     * @return $this
     */
    public function setCity($city)
    {
        return $this;
    }

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
     * @return string
     */
    public function getZip()
    {
        return;
    }

    /**
     * @param $zip
     *
     * @return $this
     */
    public function setZip($zip)
    {
        return $this;
    }

    /**
     * @param ProgramContact $program
     *
     * @return $this
     */
    public function addProgramContact(ProgramContact $contact)
    {
        return $this;
    }

    /**
     * @param ProgramContact $program
     *
     * @return bool
     */
    public function hasProgramContact(ProgramContact $contact)
    {
        return false;
    }

    /**
     * @param ProgramContact $program
     *
     * @return $this
     */
    public function removeProgramContact(ProgramContact $contact)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getProgramContacts()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countProgramContacts()
    {
        return 0;
    }

    /**
     * @return $this
     */
    public function clearProgramContacts()
    {
        return $this;
    }
}
