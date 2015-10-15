<?php

namespace Application\Entity\Base\Program;

use FzyCommon\Entity\Base\ServiceAwareEntityNull;
use Zend\Form\Element\DateTime;
use Application\Entity\Base\ProgramInterface;

class AuthorityNull extends ServiceAwareEntityNull implements AuthorityInterface
{
    /**
     * @return ProgramInterface
     */
    public function getProgram()
    {
        return new ProgramNull();
    }

    /**
     * @param $program
     *
     * @return $this
     */
    public function setProgram(ProgramInterface $program)
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getOrder()
    {
        return;
    }

    /**
     * @param $order
     *
     * @return $this
     */
    public function setOrder($order)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return;
    }

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getWebSite()
    {
        return;
    }

    /**
     * @param $webSite
     *
     * @return $this
     */
    public function setWebSite($webSite)
    {
        return $this;
    }

    /**
     * @return /DateTime
     */
    public function getEnactedDate()
    {
        return new DateTime();
    }

    /**
     * @param $date
     *
     * @return $this
     */
    public function setEnactedDate($date)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getEnactedText()
    {
        return;
    }

    /**
     * @param $text
     *
     * @return $this
     */
    public function setEnactedText($text)
    {
        return $this;
    }

    /**
     * @return /DateTime
     */
    public function getEffectiveDate()
    {
        return new DateTime();
    }

    /**
     * @param $date
     *
     * @return $this
     */
    public function setEffectiveDate($date)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getEffectiveText()
    {
        return;
    }

    /**
     * @param $text
     *
     * @return $this
     */
    public function setEffectiveText($text)
    {
        return $this;
    }

    /**
     * @return /DateTime
     */
    public function getExpiredDate()
    {
        return new DateTime();
    }

    /**
     * @param $date
     *
     * @return $this
     */
    public function setExpiredDate($date)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getExpiredText()
    {
        return;
    }

    /**
     * @param $text
     *
     * @return $this
     */
    public function setExpiredText($text)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getFile()
    {
        return;
    }

    /**
     * @param $file
     *
     * @return $this
     */
    public function setFile($file)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return '';
    }

    /**
     * @param $fileName
     *
     * @return $this
     */
    public function setFileName($fileName)
    {
        return $this;
    }
}
