<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\ContactNull as BaseContactNull;
use Doctrine\ORM\Mapping as ORM;
use Application\Entity\Base;
use Application\Entity\Base\ProgramInterface;
use Application\Entity\Base\ContactInterface as ContactEntityInterface;
use Application\Entity\Base\ProgramNull;
use Zend\Form\Annotation;

/**
 * Interface ContactInterface.
 *
 * @ORM\Entity
 * @ORM\Table(name="program_contact")
 */
class Contact extends Base implements ContactInterface
{
    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program", inversedBy="contacts")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id")
     * @Annotation\Exclude()
     *
     * @var ProgramInterface
     */
    protected $program;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Contact", inversedBy="programContacts")
     * @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     * @Annotation\Exclude()
     *
     * @var ContactEntityInterface
     */
    protected $contact;

    /**
     * @ORM\Column(type="boolean", name="webvisible", nullable=false, options={"default":1})
     * @Annotation\Type("Zend\Form\Element\Checkbox")
     * @Annotation\Attributes({"data-ng-disabled": "saving"})
     * @Annotation\Options({
     *      "label": "Web Visible",
     *      "autorender": {
     *          "ngModel": "webVisible"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\Filter({"name": "Boolean", "options": {"type": \Zend\Filter\Boolean::TYPE_ALL}})
     *
     * @var bool
     * @var bool
     */
    protected $webVisible;

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
        if ($program !== $this->getProgram()) {
            $this->getProgram()->removeContact($this);
            $this->program = $program->asDoctrineProperty();
            $program->addContact($this);
        }

        return $this;
    }

    /**
     * @return \Application\Entity\Base\ContactInterface
     */
    public function getContact()
    {
        return $this->nullGet($this->contact, new BaseContactNull());
    }

    /**
     * @param \Application\Entity\Base\ContactInterface $contact
     *
     * @return $this
     */
    public function setContact(\Application\Entity\Base\ContactInterface $contact)
    {
        $this->getContact()->removeProgramContact($this);
        $this->contact = $contact->asDoctrineProperty();
        $contact->addProgramContact($this);

        return $this;
    }

    /**
     * @return bool
     */
    public function isWebVisible()
    {
        return $this->webVisible;
    }

    /**
     * @param bool $webVisible
     *
     * @return $this
     */
    public function setWebVisible($webVisible = true)
    {
        $this->webVisible = $webVisible;

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'contact' => $this->getContact()->flatten(),
            'program' => $this->getProgram()->id(),
            'webVisible' => $this->isWebVisible(),
        ));
    }
}
