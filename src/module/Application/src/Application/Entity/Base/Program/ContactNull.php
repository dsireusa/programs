<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\ContactNull as ContactEntityNull;
use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base\ContactInterface as ContactEntityInterface;
use FzyCommon\Entity\BaseNull;

class ContactNull extends BaseNull implements ContactInterface
{
    /**
     * @return ProgramInterface
     */
    public function getProgram()
    {
        return new ProgramNull();
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program)
    {
        return $this;
    }

    /**
     * @return ContactEntityInterface
     */
    public function getContact()
    {
        return new ContactEntityNull();
    }

    /**
     * @param ContactEntityInterface $contact
     *
     * @return $this
     */
    public function setContact(ContactEntityInterface $contact)
    {
        return $this;
    }

    /**
     * @return bool
     */
    public function isWebVisible()
    {
        return false;
    }

    /**
     * @param bool $webVisible
     *
     * @return $this
     */
    public function setWebVisible($webVisible = true)
    {
        return $this;
    }
}
