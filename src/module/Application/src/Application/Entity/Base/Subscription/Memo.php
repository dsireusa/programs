<?php

namespace Application\Entity\Base\Subscription;

use Application\Entity\Base\Memo as AbstractMemo;
use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base\UserNull;
use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Base\UserInterface;

/**
 * Class SubscriptionMemo.
 *
 * @ORM\Entity
 * @ORM\Table(name="subscription_memo")
 */
class Memo extends AbstractMemo implements MemoInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\User", inversedBy="subscriptionMemos")
     * @ORM\JoinColumn(name="added_by_user", referencedColumnName="id")
     *
     * @var UserInterface
     */
    protected $addedByUser;

    /**
     * @return UserInterface
     */
    public function getAddedByUser()
    {
        return $this->nullGet($this->addedByUser, new UserNull());
    }

    /**
     * @param UserInterface $addedByUser
     *
     * @return $this
     */
    public function setAddedByUser(UserInterface $addedByUser)
    {
        $this->addedByUser = $addedByUser->asDoctrineProperty();

        return $this;
    }

    public function setProgram(ProgramInterface $program)
    {
        $this->getProgram()->removeSubscriptionMemo($this);
        $program->addSubscriptionMemo($this);

        return parent::setProgram($program);
    }
}
