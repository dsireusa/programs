<?php

namespace Application\Service\Search\Base\DQL\Program;

use Application\Service\Search\Base\DQL\Program;
use Doctrine\ORM\QueryBuilder;
use FzyCommon\Util\Params;

class Published extends Program
{
    /**
     * Add where clauses to the query.
     *
     * @param Param        $params
     * @param QueryBuilder $qb
     *
     * @return $this
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        parent::addFilters($params, $qb);

        return $this->filterByPublished($params, $qb)->filterHasName($params, $qb);
    }
}
