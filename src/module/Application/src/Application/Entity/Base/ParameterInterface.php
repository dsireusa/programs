<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Parameter\SetInterface;
use FzyCommon\Entity\BaseInterface;

interface ParameterInterface extends BaseInterface
{
    const SOURCE_OPTION_SYSTEM = 'System';
    const SOURCE_OPTION_INCENTIVE = 'Incentive';

    const QUALIFIER_OPTION_VALUE_IS = '';
    const QUALIFIER_OPTION_VALUE_MIN = 'min';
    const QUALIFIER_OPTION_VALUE_MAX = 'max';

    /**
     * @return string
     */
    public function getSource();

    /**
     * @param string $source
     *
     * @return $this
     */
    public function setSource($source);

    /**
     * @return string
     */
    public function getQualifier();

    /**
     * @param string $qualifier
     *
     * @return $this
     */
    public function setQualifier($qualifier);

    /**
     * @return float
     */
    public function getAmount();

    /**
     * @param float $amount
     *
     * @return $this
     */
    public function setAmount($amount);

    /**
     * @return string
     */
    public function getUnits();

    /**
     * @param string $units
     *
     * @return $this
     */
    public function setUnits($units);

    /**
     * @return SetInterface
     */
    public function getParameterSet();

    /**
     * @param SetInterface $paramSet
     *
     * @return $this
     */
    public function setParameterSet(SetInterface $paramSet);
}
