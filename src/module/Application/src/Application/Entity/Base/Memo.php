<?php

namespace Application\Entity\Base;

use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;
use Zend\Form\Annotation;

/**
 * Class Memo.
 *
 * @ORM\MappedSuperclass()
 */
abstract class Memo extends Base implements MemoInterface
{
    /**
     * @ORM\Column(type="datetime", name="added")
     * @Annotation\Exclude()
     *
     * @var \DateTime
     */
    protected $dateAdded;

    /**
     * @ORM\Column(type="text", name="memo")
     *
     * @var string
     */
    protected $memo;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id")
     * @Annotation\Exclude()
     *
     * @var ProgramInterface
     */
    protected $program;

    /**
     * @return UserInterface
     */
    abstract public function getAddedByUser();

    /**
     * @param UserInterface $addedByUser
     *
     * @return $this
     */
    abstract public function setAddedByUser(UserInterface$addedByUser);

    /**
     * @return \DateTime
     */
    public function getDateAddedTS()
    {
        return $this->tsGet($this->dateAdded);
    }

    /**
     * @param \DateTime $ts
     *
     * @return $this
     */
    public function setDateAddedTS($ts)
    {
        $this->dateAdded = $this->tsSet($ts);

        return $this;
    }

    /**
     * @return string
     */
    public function getMemo()
    {
        return $this->memo;
    }

    /**
     * @param string $memo
     *
     * @return $this
     */
    public function setMemo($memo)
    {
        $this->memo = $memo;

        return $this;
    }

    /**
     * @return ProgramInterface
     */
    public function getProgram()
    {
        return $this->nullGet($this->program, new ProgramNull());
    }

    /**
     * @param ProgramInterface $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program)
    {
        $this->program = $program->asDoctrineProperty();

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'dateAdded' => $this->tsGetFormatted($this->dateAdded, 'm/d/Y'),
            'author' => $this->getAddedByUser()->flatten(),
            'memo' => $this->getMemo(),
        ));
    }
}
