<?php

namespace Application\Entity;

class Base extends \FzyCommon\Entity\Base
{
    public function addSelfTo(\Doctrine\Common\Collections\Collection $collection, $allowDuplicates = false)
    {
        if ($allowDuplicates || !$collection->contains($this)) {
            return parent::addSelfTo($collection);
        }

        return $this;
    }
}
