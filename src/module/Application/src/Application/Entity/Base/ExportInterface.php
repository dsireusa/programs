<?php

namespace Application\Entity\Base;

use FzyCommon\Entity\Base\ServiceAwareEntityInterface;

interface ExportInterface extends ServiceAwareEntityInterface
{
    const TYPE_CSV = 'csv';
    const TYPE_XML = 'xml';

    /**
     * @return string
     */
    public function getKey();

    /**
     * @param $key
     *
     * @return $this
     */
    public function setKey($key);

    /**
     * @return \DateTime
     */
    public function getCreatedTs();

    /**
     * @param $ts
     *
     * @return $this
     */
    public function setCreatedTs($ts);

    /**
     * @return string
     */
    public function getType();

    /**
     * @param $type
     *
     * @return $this
     */
    public function setType($type);

    /**
     * @return int
     */
    public function getSize();

    /**
     * @param $size
     *
     * @return $this
     */
    public function setSize($size);
}
