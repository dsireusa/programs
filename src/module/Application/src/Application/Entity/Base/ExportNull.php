<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\Base\ServiceAwareEntityNull;

class ExportNull extends ServiceAwareEntityNull implements ExportInterface
{
    /**
     * @return string
     */
    public function getKey()
    {
        return '';
    }

    /**
     * @param $key
     *
     * @return $this
     */
    public function setKey($key)
    {
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedTs()
    {
        return new \DateTime();
    }

    /**
     * @param $ts
     *
     * @return $this
     */
    public function setCreatedTs($ts)
    {
        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return;
    }

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type)
    {
        return $this;
    }

    /**
     * @return int
     */
    public function getSize()
    {
        return 0;
    }

    /**
     * @param $size
     *
     * @return $this
     */
    public function setSize($size)
    {
        return $this;
    }
}
