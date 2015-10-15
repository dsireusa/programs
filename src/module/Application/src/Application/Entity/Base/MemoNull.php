<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\BaseNull;

class MemoNull extends BaseNull implements MemoInterface
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
     * @return UserInterface
     */
    public function getAddedByUser()
    {
        return new UserNull();
    }

    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function setAddedByUser(UserInterface $user)
    {
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateAddedTS()
    {
        return new \DateTime();
    }

    /**
     * @param mixed $ts
     *
     * @return $this
     */
    public function setDateAddedTS($ts)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getMemo()
    {
        return;
    }

    /**
     * @param string $memo
     *
     * @return $this
     */
    public function setMemo($memo)
    {
        return $this;
    }
}
