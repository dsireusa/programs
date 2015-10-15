<?php

namespace Application\Entity\Base;

use Doctrine\ORM\Mapping as ORM;
use FzyCommon\Entity\Base\ServiceAwareEntity;

/**
 * Class Utility.
 *
 * @ORM\Entity
 * @ORM\Table(name="export")
 */
class Export extends ServiceAwareEntity implements ExportInterface
{
    /**
     * @ORM\Column(type="string", name="`key`", length=255)
     *
     * @var string
     */
    protected $key;

    /**
     * @ORM\Column(type="datetime", name="created_ts")
     *
     * @var \DateTime
     */
    protected $createdTs;

    /**
     * @ORM\Column(type="string", name="`type`", length=8)
     *
     * @var string
     */
    protected $type;

    /**
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    protected $size;

    public function __construct()
    {
        $this->setCreatedTs('now');
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return $this->tsGet($this->createdTs);
    }

    /**
     * @param \DateTime $createdTs
     */
    public function setCreatedTs($createdTs)
    {
        $this->createdTs = $this->tsSet($createdTs);

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param int $size
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    public function flatten()
    {
        return array_merge(parent::flatten(), array(
            'key' => $this->getKey(),
            'type' => 'file',
            'url' => trim($this->getKey()) ? $this->getServiceLocator()->get('FzyCommon\Url')->fromS3($this->getKey(), '+1 week') : null,
            'size' => $this->getSize(),
        ));
    }
}
