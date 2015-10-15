<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\HasProgramInterface;
use FzyCommon\Entity\BaseInterface;

/**
 * Interface ContactInterface.
 */
interface ContactInterface extends BaseInterface, HasProgramInterface
{
    /**
     * @return \Application\Entity\Base\ContactInterface
     */
    public function getContact();

    /**
     * @param \Application\Entity\Base\ContactInterface $contact
     *
     * @return $this
     */
    public function setContact(\Application\Entity\Base\ContactInterface $contact);

    /**
     * @return bool
     */
    public function isWebVisible();

    /**
     * @param bool $webVisible
     *
     * @return $this
     */
    public function setWebVisible($webVisible = true);
}
