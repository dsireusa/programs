<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Program\MemoInterface as ProgramMemoInterface;
use Application\Entity\Base\Subscription\MemoInterface as SubscriptionMemoInterface;
use Application\Service\Search\Base\Role;
use Doctrine\Common\Collections\ArrayCollection;
use FzyAuth\Entity\Base\AbstractUser;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @Annotation\Options({
 *      "autorender": {
 *          "ngModel": "user",
 *          "fieldsets": {
 *              {
 *                  "name": \FzyForm\Annotation\FieldSet::DEFAULT_NAME,
 *                  "legend": "User Information"
 *              }
 *          }
 *      }
 * })
 */
class User extends AbstractUser implements UserInterface
{
    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Subscription\Memo", mappedBy="addedByUser", fetch="EXTRA_LAZY")
     * @Annotation\Exclude();
     *
     * @var Collection
     */
    protected $subscriptionMemos;

    /**
     * @ORM\OneToMany(targetEntity="Application\Entity\Base\Program\Memo", mappedBy="addedByUser", fetch="EXTRA_LAZY")
     * @Annotation\Exclude();
     *
     * @var Collection
     */
    protected $programMemos;

    public function __construct()
    {
        parent::__construct();
        $this->role = UserInterface::ROLE_USER;
        $this->programMemos = new ArrayCollection();
        $this->subscriptionMemos = new ArrayCollection();
    }
    public function flatten()
    {
        $roles = Role::get();

        return array_merge(parent::flatten(), array(
            'roleObject' => isset($roles[$this->getRole()]) ? Role::transform($this->getRole(), $roles[$this->getRole()]) : null,
        ));
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function addSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        $subMemo->addSelfTo($this->subscriptionMemos);

        return $this;
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return bool
     */
    public function hasSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        return $this->subscriptionMemos->contains($subMemo);
    }

    /**
     * @param SubscriptionMemoInterface $subMemo
     *
     * @return $this
     */
    public function removeSubscriptionMemo(SubscriptionMemoInterface $subMemo)
    {
        $this->subscriptionMemos->removeElement($subMemo);

        return $this;
    }

    /**
     * @return array
     */
    public function getSubscriptionMemos()
    {
        return $this->subscriptionMemos->toArray();
    }

    /**
     * @return int
     */
    public function countSubscriptionMemos()
    {
        return $this->subscriptionMemos->count();
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function addProgramMemo(ProgramMemoInterface $programMemo)
    {
        $programMemo->addSelfTo($this->programMemos);

        return $this;
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return bool
     */
    public function hasProgramMemo(ProgramMemoInterface $programMemo)
    {
        return $this->programMemos->contains($programMemo);
    }

    /**
     * @param ProgramMemoInterface $programMemo
     *
     * @return $this
     */
    public function removeProgramMemo(ProgramMemoInterface $programMemo)
    {
        $this->programMemos->removeElement($programMemo);

        return $this;
    }

    /**
     * @return array
     */
    public function getProgramMemos()
    {
        return $this->programMemos->toArray();
    }

    /**
     * @return int
     */
    public function countProgramMemos()
    {
        return $this->programMemos->count();
    }
}
