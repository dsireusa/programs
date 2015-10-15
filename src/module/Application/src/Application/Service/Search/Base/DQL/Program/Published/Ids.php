<?php

namespace Application\Service\Search\Base\DQL\Program\Published;

use Application\Service\Search\Base\DQL\Program\Published;
use FzyCommon\Util\Params;

class Ids extends Published
{
    public function getLimit()
    {
        //no limit
        return -1;
    }

    /** Process to only pass needed id
     * @param $entity
     * @param Params             $params
     * @param array|\Traversable $results
     * @param bool               $asEntity
     *
     * @return array
     */
    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        return array('id' => $entity->id());
    }
}
