<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Program\ContactInterface as ProgramContact;
use FzyCommon\Entity\BaseInterface;

interface ContactInterface extends BaseInterface
{
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
     * @return string
     */
    public function getFirstName();

    /**
     * @param $firstName
     *
     * @return $this
     */
    public function setFirstName($firstName);

    /**
     * @return string
     */
    public function getLastName();

    /**
     * @param $lastName
     *
     * @return $this
     */
    public function setLastName($lastName);

    /**
     * @return string
     */
    public function getOrganizationName();

    /**
     * @param $orgName
     *
     * @return $this
     */
    public function setOrganizationName($orgName);

    /**
     * @return bool
     */
    public function isWebVisibleDefault();

    /**
     * @param bool $isWebVisible
     *
     * @return $this
     */
    public function setWebVisibleDefault($isWebVisible = true);

    /**
     * @return string
     */
    public function getPhone();

    /**
     * @param $phone
     *
     * @return $this
     */
    public function setPhone($phone);

    /**
     * @return string
     */
    public function getEmail();

    /**
     * @param $email
     *
     * @return $this
     */
    public function setEmail($email);

    /**
     * @return string
     */
    public function getWebsiteUrl();

    /**
     * @param $websiteUrl
     *
     * @return $this
     */
    public function setWebsiteUrl($websiteUrl);

    /**
     * @return string
     */
    public function getAddress();

    /**
     * @param $address
     *
     * @return $this
     */
    public function setAddress($address);

    /**
     * @return string
     */
    public function getCity();

    /**
     * @param $city
     *
     * @return $this
     */
    public function setCity($city);

    /**
     * @return StateInterface
     */
    public function getState();

    /**
     * @param StateInterface $state
     *
     * @return mixed
     */
    public function setState(StateInterface $state);

    /**
     * @return ZipCode
     */
    public function getZip();

    /**
     * @param $zip
     *
     * @return $this
     */
    public function setZip($zip);

    /**
     * @param ProgramContact $contact
     *
     * @return $this
     */
    public function addProgramContact(ProgramContact $contact);

    /**
     * @param ProgramContact $contact
     *
     * @return bool
     */
    public function hasProgramContact(ProgramContact $contact);

    /**
     * @param ProgramContact $contact
     *
     * @return $this
     */
    public function removeProgramContact(ProgramContact $contact);

    /**
     * @return $this
     */
    public function clearProgramContacts();

    /**
     * @return array
     */
    public function getProgramContacts();

    /**
     * @return int
     */
    public function countProgramContacts();
}
