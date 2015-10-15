<?php

namespace Application\Service\Search\Base\DQL\Utility;

use Application\Service\Search\Base\DQL\Utility;
use FzyCommon\Util\Params;
use Doctrine\ORM\QueryBuilder;

class HasProgram extends Utility
{
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterByPrograms($params, $qb);
    }
}
