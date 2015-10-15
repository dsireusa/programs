<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Program\MemoInterface as ProgramMemoInterface;
use Application\Entity\Base\Subscription\MemoInterface as SubscriptionMemoInterface;
use FzyAuth\Entity\Base\UserInterface as AuthUserInterface;

interface UserInterface extends AuthUserInterface
{
    const ROLE_ADMIN = 'admin';

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function addSubscriptionMemo(SubscriptionMemoInterface $subMemo);

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return bool
     */
    public function hasSubscriptionMemo(SubscriptionMemoInterface $subMemo);

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function removeSubscriptionMemo(SubscriptionMemoInterface $subMemo);

    /**
     * @return array
     */
    public function getSubscriptionMemos();

    /**
     * @return int
     */
    public function countSubscriptionMemos();

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function addProgramMemo(ProgramMemoInterface $programMemo);

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return bool
     */
    public function hasProgramMemo(ProgramMemoInterface $programMemo);

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function removeProgramMemo(ProgramMemoInterface $programMemo);

    /**
     * @return array
     */
    public function getProgramMemos();

    /**
     * @return int
     */
    public function countProgramMemos();
}
