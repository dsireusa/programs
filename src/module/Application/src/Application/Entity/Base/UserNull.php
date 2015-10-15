<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Program\MemoInterface as ProgramMemoInterface;
use Application\Entity\Base\Subscription\MemoInterface as SubscriptionMemoInterface;
use FzyAuth\Entity\Base\UserNull as FzyUserNull;

class UserNull extends FzyUserNull implements UserInterface
{
    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function addSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return $this;
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return bool
     */
    public function hasSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return false;
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function removeSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getSubscriptionMemos()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countSubscriptionMemos()
    {
        return 0;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function addProgramMemo(ProgramMemoInterface $programMemo)
    {
        return $this;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return bool
     */
    public function hasProgramMemo(ProgramMemoInterface $programMemo)
    {
        return false;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function removeProgramMemo(ProgramMemoInterface $programMemo)
    {
        return $this;
    }

    /**
     * @return array
     */
    public function getProgramMemos()
    {
        return array();
    }

    /**
     * @return int
     */
    public function countProgramMemos()
    {
        return 0;
    }
}
