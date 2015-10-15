<?php

namespace Application\Service\Search\Base\DQL\Type;

use Application\Service\Search\Base\DQL\Type;
use Doctrine\ORM\QueryBuilder;
use FzyCommon\Util\Params;

class Published extends Type
{
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        return parent::addFilters($params, $qb)->filterByPublished($params, $qb);
    }

    protected function filterByPublished(Params $params, QueryBuilder $qb)
    {
        return $this;
    }
}
