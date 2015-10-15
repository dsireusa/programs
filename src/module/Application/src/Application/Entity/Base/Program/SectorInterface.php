<?php

namespace Application\Entity\Base\Program;

use Application\Entity\Base\HasMultiProgramInterface;
use FzyCommon\Entity\BaseInterface;

interface SectorInterface extends BaseInterface, HasMultiProgramInterface
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @param $name
     *
     * @return string
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getFieldName();

    /**
     * @param $name
     *
     * @return string
     */
    public function setFieldName($name);

    /**
     * @return bool
     */
    public function isSelectable();

    /**
     * @param bool $selectable
     *
     * @return $this
     */
    public function setSelectable($selectable = true);

    /**
     * @return SectorInterface
     */
    public function getParent();

    /**
     * @param SectorInterface $parent
     *
     * @return $this
     */
    public function setParent(SectorInterface $parent);

    /**
     * @return array
     */
    public function getChildren();

    /**
     * @param SectorInterface $sector
     *
     * @return bool
     */
    public function hasChild(SectorInterface $sector);

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function addChild(SectorInterface $sector);

    /**
     * @param SectorInterface $sector
     *
     * @return $this
     */
    public function removeChild(SectorInterface $sector);

    /**
     * @return int
     */
    public function countChildren();
}
