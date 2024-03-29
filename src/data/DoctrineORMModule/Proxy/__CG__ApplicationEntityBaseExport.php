<?php

namespace DoctrineORMModule\Proxy\__CG__\Application\Entity\Base;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Export extends \Application\Entity\Base\Export implements \Doctrine\ORM\Proxy\Proxy
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
            return array('__isInitialized__', 'key', 'createdTs', 'type', 'size', 'id');
        }

        return array('__isInitialized__', 'key', 'createdTs', 'type', 'size', 'id');
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Export $proxy) {
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
    public function getKey()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getKey', array());

        return parent::getKey();
    }

    /**
     * {@inheritDoc}
     */
    public function setKey($key)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setKey', array($key));

        return parent::setKey($key);
    }

    /**
     * {@inheritDoc}
     */
    public function getCreatedTs()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCreatedTs', array());

        return parent::getCreatedTs();
    }

    /**
     * {@inheritDoc}
     */
    public function setCreatedTs($createdTs)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCreatedTs', array($createdTs));

        return parent::setCreatedTs($createdTs);
    }

    /**
     * {@inheritDoc}
     */
    public function getType()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getType', array());

        return parent::getType();
    }

    /**
     * {@inheritDoc}
     */
    public function setType($type)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setType', array($type));

        return parent::setType($type);
    }

    /**
     * {@inheritDoc}
     */
    public function getSize()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getSize', array());

        return parent::getSize();
    }

    /**
     * {@inheritDoc}
     */
    public function setSize($size)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setSize', array($size));

        return parent::setSize($size);
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
    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setServiceLocator', array($serviceLocator));

        return parent::setServiceLocator($serviceLocator);
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceLocator()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getServiceLocator', array());

        return parent::getServiceLocator();
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
    public function addSelfTo(\Doctrine\Common\Collections\Collection $collection, $allowDuplicates = false)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'addSelfTo', array($collection, $allowDuplicates));

        return parent::addSelfTo($collection, $allowDuplicates);
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
