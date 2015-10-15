<?php

namespace Application\Service\Search\Base\DQL\Sector;

use Application\Service\Search\Base\DQL\Sector;
use FzyCommon\Util\Params;

/**
 * Class Map.
 */
class Map extends Sector
{
    /**
     * @param $entity
     * @param Params             $params
     * @param array|\Traversable $results
     * @param bool               $asEntity
     *
     * @return array
     */
    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        /* @var $entity \Application\Entity\Base\Program\Sector */
        $result = parent::process($entity, $params, $results, $asEntity);
        if ($asEntity) {
            return $result;
        }
        if ($entity->countChildren()) {
            $children = array();
            foreach ($entity->getChildren() as $child) {
                $children[] = $this->process($child, $params, $results, $asEntity);
            }
            $result['children'] = $children;
        }

        return $result;
    }
}
