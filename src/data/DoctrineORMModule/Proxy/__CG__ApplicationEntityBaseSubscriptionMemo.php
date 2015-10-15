<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity\Base\Subscription;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Memo extends \Application\Entity\Base\Subscription\Memo implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = array();



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return array('__isInitialized__', 'addedByUser', 'dateAdded', 'memo', 'program', 'id');
        }

        return array('__isInitialized__', 'addedByUser', 'dateAdded', 'memo', 'program', 'id');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Memo $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', array());
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', array());
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getAddedByUser()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getAddedByUser', array());

        return parent::getAddedByUser();
    }

    /**
     * {@inheritDoc}
     */
    public function setAddedByUser(\Application\Entity\Base\UserInterface $addedByUser)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setAddedByUser', array($addedByUser));

        return parent::setAddedByUser($addedByUser);
    }

    /**
     * {@inheritDoc}
     */
    public function setProgram(\Application\Entity\Base\ProgramInterface $program)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setProgram', array($program));

        return parent::setProgram($program);
    }

    /**
     * {@inheritDoc}
     */
    public function getDateAddedTS()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getDateAddedTS', array());

        return parent::getDateAddedTS();
    }

    /**
     * {@inheritDoc}
     */
    public function setDateAddedTS($ts)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setDateAddedTS', array($ts));

        return parent::setDateAddedTS($ts);
    }

    /**
     * {@inheritDoc}
     */
    public function getMemo()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getMemo', array());

        return parent::getMemo();
    }

    /**
     * {@inheritDoc}
     */
    public function setMemo($memo)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setMemo', array($memo));

        return parent::setMemo($memo);
    }

    /**
     * {@inheritDoc}
     */
    public function getProgram()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getProgram', array());

        return parent::getProgram();
    }

    /**
     * {@inheritDoc}
     */
    public function flatten()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'flatten', array());

        return parent::flatten();
    }

    /**
     * {@inheritDoc}
     */
    public function addSelfTo(\Doctrine\Common\Collections\Collection $collection, $allowDuplicates = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSelfTo', array($collection, $allowDuplicates));

        return parent::addSelfTo($collection, $allowDuplicates);
    }

    /**
     * {@inheritDoc}
     */
    public function id()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'id', array());

        return parent::id();
    }

    /**
     * {@inheritDoc}
     */
    public function isNull()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isNull', array());

        return parent::isNull();
    }

    /**
     * {@inheritDoc}
     */
    public function flatCollection($collection, $extended = false, $indexById = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'flatCollection', array($collection, $extended, $indexById));

        return parent::flatCollection($collection, $extended, $indexById);
    }

    /**
     * {@inheritDoc}
     */
    public function asDoctrineProperty()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'asDoctrineProperty', array());

        return parent::asDoctrineProperty();
    }

    /**
     * {@inheritDoc}
     */
    public function nullGet(\FzyCommon\Entity\BaseInterface $entity = NULL, \FzyCommon\Entity\BaseNull $nullObject = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'nullGet', array($entity, $nullObject));

        return parent::nullGet($entity, $nullObject);
    }

    /**
     * {@inheritDoc}
     */
    public function tsSet($ts, $createIfEmpty = true, $timezone = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tsSet', array($ts, $createIfEmpty, $timezone));

        return parent::tsSet($ts, $createIfEmpty, $timezone);
    }

    /**
     * {@inheritDoc}
     */
    public function tsGet(\DateTime $tsProperty = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tsGet', array($tsProperty));

        return parent::tsGet($tsProperty);
    }

    /**
     * {@inheritDoc}
     */
    public function tsGetFormatted(\DateTime $tsProperty = NULL, $format = 'Y-m-d', $timezone = NULL)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'tsGetFormatted', array($tsProperty, $format, $timezone));

        return parent::tsGetFormatted($tsProperty, $format, $timezone);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', array());

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getFormTag()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getFormTag', array());

        return parent::getFormTag();
    }

    /**
     * {@inheritDoc}
     */
    public function setFormTag($tag)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setFormTag', array($tag));

        return parent::setFormTag($tag);
    }

    /**
     * {@inheritDoc}
     */
    public function jsonSerialize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'jsonSerialize', array());

        return parent::jsonSerialize();
    }

}
