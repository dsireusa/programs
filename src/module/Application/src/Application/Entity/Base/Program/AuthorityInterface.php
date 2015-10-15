<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\HasProgramInterface;
use FzyCommon\Entity\Base\ServiceAwareEntityInterface;
use FzyCommon\Entity\BaseInterface;

interface AuthorityInterface extends BaseInterface, ServiceAwareEntityInterface, HasProgramInterface
{
    /**
     * @return int
     */
    public function getOrder();

    /**
     * @param $order
     *
     * @return $this
     */
    public function setOrder($order);

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param $code
     *
     * @return $this
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getWebSite();

    /**
     * @param $webSite
     *
     * @return $this
     */
    public function setWebSite($webSite);

    /**
     * @return /DateTime
     */
    public function getEnactedDate();

    /**
     * @param $date
     *
     * @return $this
     */
    public function setEnactedDate($date);

    /**
     * @return string
     */
    public function getEnactedText();

    /**
     * @param $text
     *
     * @return $this
     */
    public function setEnactedText($text);

    /**
     * @return /DateTime
     */
    public function getEffectiveDate();

    /**
     * @param $date
     *
     * @return $this
     */
    public function setEffectiveDate($date);

    /**
     * @return string
     */
    public function getEffectiveText();

    /**
     * @param $text
     *
     * @return $this
     */
    public function setEffectiveText($text);

    /**
     * @return /DateTime
     */
    public function getExpiredDate();

    /**
     * @param $date
     *
     * @return $this
     */
    public function setExpiredDate($date);

    /**
     * @return string
     */
    public function getExpiredText();

    /**
     * @param $text
     *
     * @return $this
     */
    public function setExpiredText($text);

    /**
     * @return string
     */
    public function getFile();

    /**
     * @param $file
     *
     * @return $this
     */
    public function setFile($file);

    /**
     * @return string
     */
    public function getFileName();

    /**
     * @param $fileName
     *
     * @return $this
     */
    public function setFileName($fileName);
}
