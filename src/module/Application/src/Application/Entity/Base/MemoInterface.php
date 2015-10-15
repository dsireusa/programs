<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\BaseInterface;

interface MemoInterface extends BaseInterface, HasProgramInterface
{
    /**
     * @return UserInterface
     */
    public function getAddedByUser();

    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function setAddedByUser(UserInterface $user);

    /**
     * @return \DateTime
     */
    public function getDateAddedTS();

    /**
     * @param mixed $ts
     *
     * @return $this
     */
    public function setDateAddedTS($ts);

    /**
     * @return string
     */
    public function getMemo();

    /**
     * @param string $memo
     *
     * @return $this
     */
    public function setMemo($memo);
}
