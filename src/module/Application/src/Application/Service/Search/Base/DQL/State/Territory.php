<?php

namespace Application\Service\Search\Base\DQL\State;

use Application\Service\Search\Base\DQL\State;
use FzyCommon\Util\Params;
use Doctrine\ORM\QueryBuilder;
use Zend\Dom\Query;

class Territory extends State
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

        return $this->filterToTerritories($params, $qb);
    }

    public function getLimit()
    {
        return -1;
    }
}
