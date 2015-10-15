<?php

namespace Application\Entity\Base;

use Application\Entity\Base\Parameter\SetInterface;
use Application\Entity\Base\Parameter\SetNull;
use Application\Entity\Base;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Parameter.
 *
 * @ORM\Entity
 * @ORM\Table(name="parameter")
 */
class Parameter extends Base implements ParameterInterface
{
    /**
     * @ORM\Column(type="string", length=45, name="source")
     *
     * @var string
     */
    protected $source;

    /**
     * @ORM\Column(type="string", length=45, name="qualifier")
     *
     * @var string
     */
    protected $qualifier;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, name="amount")
     *
     * @var string
     */
    protected $amount;

    /**
     * @ORM\Column(type="string", length=45, name="units")
     *
     * @var string
     */
    protected $units;

    /**
     * @ORM\ManyToOne(targetEntity="Application\Entity\Base\Parameter\Set")
     * @ORM\JoinColumn(name="parameter_set_id", referencedColumnName="id")
     *
     * @var SetInterface
     */
    protected $parameterSet;

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     *
     * @return $this
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * @return SetInterface
     */
    public function getParameterSet()
    {
        return $this->nullGet($this->parameterSet, new SetNull());
    }

    /**
     * @param SetInterface $parameterSet
     *
     * @return $this
     */
    public function setParameterSet(SetInterface $parameterSet)
    {
        $this->getParameterSet()->removeParameter($this);
        $this->parameterSet = $parameterSet->asDoctrineProperty();
        $this->getParameterSet()->addParameter($this);

        return $this;
    }

    /**
     * @return string
     */
    public function getQualifier()
    {
        return $this->qualifier;
    }

    /**
     * @param string $qualifier
     *
     * @return $this
     */
    public function setQualifier($qualifier)
    {
        $this->qualifier = $qualifier;

        return $this;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     *
     * @return $this
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * @param string $units
     *
     * @return $this
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }

    public function flatten()
    {
        return array_merge(array(
            'source' => $this->getSource(),
            'qualifier' => $this->getQualifier(),
            'amount' => $this->getAmount(),
            'units' => $this->getUnits(),
        ), parent::flatten());
    }
}
