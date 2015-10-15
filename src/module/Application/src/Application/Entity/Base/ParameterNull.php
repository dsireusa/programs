<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Parameter\SetInterface;
use Application\Entity\Base\Parameter\SetNull;
use FzyCommon\Entity\BaseNull;

class ParameterNull extends BaseNull implements ParameterInterface
{
    /**
     * @return string
     */
    public function getSource()
    {
        return;
    }
    /**
     * @param string $source
     *
     * @return $this
     */
    public function setSource($source)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getQualifier()
    {
        return;
    }

    /**
     * @param string $qualifier
     *
     * @return $this
     */
    public function setQualifier($qualifier)
    {
        return $this;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return 0;
    }

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getUnits()
    {
        return;
    }

    /**
     * @param string $units
     *
     * @return $this
     */
    public function setUnits($units)
    {
        return $this;
    }

    /**
     * @return SetInterface
     */
    public function getParameterSet()
    {
        return new SetNull();
    }

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function setParameterSet(SetInterface $paramSet)
    {
        return $this;
    }
}
