<?php

namespace Application\Entity\Base\Program;

use Doctrine\ORM\Mapping as ORM;
use FzyCommon\Entity\Base\ServiceAwareEntity;
use Zend\Form\Annotation;
use Application\Entity\Base\ProgramNull;
use Application\Entity\Base\ProgramInterface;

/**
 * Class Authority.
 *
 * @ORM\Entity
 * @ORM\Table(name="authority")
 * @Annotation\Options({
 *      "autorender": {
 *          "ngModel": "authority",
 *          "suppressDenotesText": true
 *      }
 * })
 */
class Authority extends ServiceAwareEntity implements AuthorityInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="code")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({"required": true})
     * @Annotation\Options({
     *      "label": "Authority Name",
     *      "autorender": {
     *          "ngModel": "code"
     *      }
     * })
     * @Annotation\Required(true)
     * @Annotation\ErrorMessage("Please specify an authority name.")
     *
     * @var string
     */
    protected $code;

    /**
     * @ORM\Column(type="string", length=255, name="website")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "Website",
     *      "autorender": {
     *          "ngModel": "website"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\Filter({"name": "StringTrim"})
     * @Annotation\Validator({"name": "Uri", "options": {"allowRelative": false}})
     * @Annotation\ErrorMessage("Please specify an authority website.")
     *
     * @var string
     */
    protected $website;

    /**
     * @ORM\Column(type="string", length=255, name="file_key")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "label": "File",
     *      "autorender": {
     *          "ngModel": "upload",
     *          "url": "'/api/v1/programs/'+program.id+'/authorities/upload'",
     *          "inputTemplate": "partials/form/upload"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify an authority file.")
     *
     * @var string
     */
    protected $file;

    /**
     * @ORM\Column(type="string", length=255, name="file_name")
     *
     * @var string
     */
    protected $fileName;

    /**
     * @ORM\Column(type="datetime", name="enacted")
     * @Annotation\Type("Zend\Form\Element\DateTime")
     * @Annotation\Attributes({
     *  "data-ui-date": "dateOptions",
     *  "data-ui-date-format": "yy-mm-dd"
     * })
     * @Annotation\Options({
     *      "label": "Date Enacted",
     *      "autorender": {
     *          "ngModel": "enactedDate",
     *          "row": "enacted"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify an enacted date.")
     *
     * @var /DateTime
     */
    protected $enactedDate;

    /**
     * @ORM\Column(type="string", length=45, name="enactedtext")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "autorender": {
     *          "ngModel": "enactedText",
     *          "row": "enacted",
     *          "noLabel": true,
     *          "inputTemplate": "partials/form/hidden-input"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify enacted text.")
     *
     * @var string
     */
    protected $enactedText;

    /**
     * @ORM\Column(type="datetime", name="effective")
     * @Annotation\Type("Zend\Form\Element\DateTime")
     * @Annotation\Attributes({
     *  "data-ui-date": "dateOptions",
     *  "data-ui-date-format": "yy-mm-dd"
     * })
     * @Annotation\Options({
     *      "label": "Effective Date",
     *      "autorender": {
     *          "ngModel": "effectiveDate",
     *          "row": "effective"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify an effective date.")
     *
     * @var \DateTime
     */
    protected $effectiveDate;

    /**
     * @ORM\Column(type="string", length=255, name="effectivetext")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "autorender": {
     *          "ngModel": "effectiveText",
     *          "row": "effective",
     *          "noLabel": true,
     *          "inputTemplate": "partials/form/hidden-input"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify effective text.")
     *
     * @var string
     */
    protected $effectiveText;

    /**
     * @ORM\Column(type="datetime", name="expired")
     * @Annotation\Type("Zend\Form\Element\DateTime")
     * @Annotation\Attributes({
     *  "data-ui-date": "dateOptions",
     *  "data-ui-date-format": "yy-mm-dd"
     * })
     * @Annotation\Options({
     *      "label": "Expiration Date",
     *      "autorender": {
     *          "ngModel": "expiredDate",
     *          "row": "expired"
     *      }})
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify an expiration date.")
     *
     * @var \DateTime
     */
    protected $expiredDate;

    /**
     * @ORM\Column(type="string", length=255, name="expiredtext")
     * @Annotation\Type("Zend\Form\Element\Text")
     * @Annotation\Attributes({})
     * @Annotation\Options({
     *      "autorender": {
     *          "ngModel": "expiredText",
     *          "row": "expired",
     *          "noLabel": true,
     *          "inputTemplate": "partials/form/hidden-input"
     *      }
     * })
     * @Annotation\AllowEmpty()
     * @Annotation\ErrorMessage("Please specify expired text.")
     *
     * @var string
     */
    protected $expiredText;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Program")
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id")
     *
     * @var ProgramInterface
     */
    protected $program;

    /**
     * @ORM\Column(type="integer", name="`order`")
     *
     * @var int
     */
    protected $order;

    /**
     * @return /DateTime
     */
    public function getEffectiveDate()
    {
        return $this->effectiveDate;
    }

    /**
     * @param /DateTime $effectiveDate
     */
    public function setEffectiveDate($effectiveDate)
    {
        $this->effectiveDate = $this->tsSet($effectiveDate, false);

        return $this;
    }

    /**
     * @return string
     */
    public function getEffectiveText()
    {
        return $this->effectiveText;
    }

    /**
     * @param string $effectiveText
     */
    public function setEffectiveText($effectiveText)
    {
        $this->effectiveText = $effectiveText;

        return $this;
    }

    /**
     * @return /DateTime
     */
    public function getEnactedDate()
    {
        return $this->enactedDate;
    }

    /**
     * @param /DateTime $enactedDate
     */
    public function setEnactedDate($enactedDate)
    {
        $this->enactedDate = $this->tsSet($enactedDate, false);

        return $this;
    }

    /**
     * @return string
     */
    public function getEnactedText()
    {
        return $this->enactedText;
    }

    /**
     * @param string $enactedText
     */
    public function setEnactedText($enactedText)
    {
        $this->enactedText = $enactedText;

        return $this;
    }

    /**
     * @return /DateTime
     */
    public function getExpiredDate()
    {
        return $this->expiredDate;
    }

    /**
     * @param /DateTime $expiredDate
     */
    public function setExpiredDate($expiredDate)
    {
        $this->expiredDate = $this->tsSet($expiredDate, false);

        return $this;
    }

    /**
     * @return string
     */
    public function getExpiredText()
    {
        return $this->expiredText;
    }

    /**
     * @param string $expiredText
     */
    public function setExpiredText($expiredText)
    {
        $this->expiredText = $expiredText;

        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param int $order
     */
    public function setOrder($order)
    {
        $this->order = $order;

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
     */
    public function setProgram(ProgramInterface $program)
    {
        if ($program !== $this->getProgram()) {
            $this->getProgram()->removeAuthority($this);
            $this->program = $program->asDoctrineProperty();
            $program->addAuthority($this);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    public function flatten()
    {
        /* @var $s3 \Aws\S3\S3Client */
        $s3 = $this->getServiceLocator()->get('FzyCommon\Service\Aws\S3');

        return array_merge(parent::flatten(), array(
            'code' => $this->getCode(),
            'website' => $this->getWebsite(),
            'upload' => array(
                'key' => $this->getFile(),
                'fileName' => $this->getFileName(),
                'url' => trim($this->getFile()) ? $this->getServiceLocator()->get('FzyCommon\Url')->fromS3($this->getFile(), '+1 week', $this->getFileName()) : null,
            ),
            'effectiveDate' => $this->tsGetFormatted($this->getEffectiveDate()),
            'effectiveDateDisplay' => $this->getEffectiveDate() ? $this->tsGetFormatted($this->getEffectiveDate(), 'm/d/Y') : $this->getEffectiveText(),
            'effectiveText' => $this->getEffectiveText(),
            'enactedDate' => $this->tsGetFormatted($this->getEnactedDate()),
            'enactedDateDisplay' => $this->getEnactedDate() ? $this->tsGetFormatted($this->getEnactedDate(), 'm/d/Y') : $this->getEnactedText(),
            'enactedText' => $this->getEnactedText(),
            'expiredDate' => $this->tsGetFormatted($this->getExpiredDate()),
            'expiredDateDisplay' => $this->getExpiredDate() ? $this->tsGetFormatted($this->getExpiredDate(), 'm/d/Y') : $this->getExpiredText(),
            'expiredText' => $this->getExpiredText(),
        ));
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     *
     * @return $this
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;

        return $this;
    }
}
