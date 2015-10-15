<?php

namespace Application\Service\Search\Base\DQL\Program;

use Application\Service\Search\Base\DQL\Program;
use Doctrine\ORM\QueryBuilder;
use FzyCommon\Util\Params;

class GetProgramsByDate extends Program
{
    /**
     * Add where clauses to the query
     * @param  Param        $params
     * @param  QueryBuilder $qb
     * @return $this
     */
    protected function addFilters(Params $params, QueryBuilder $qb)
    {
        parent::addFilters($params, $qb);

        return $this->filterHasName($params, $qb);
    }

    public function getLimit()
    {
        //no limit
    }
    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        $object = parent::process($entity, $params, $results, $asEntity);
        if (!$asEntity) {
            $array = array(
                'Name' => $entity->getName(),
                'Code' => $entity->getCode(),
                'LastUpdate' => $entity->tsGetFormatted($entity->getUpdatedTS(), 'm/d/Y'),
                'Published'  => $entity->isPublished(),
            );
            if ($entity->isPublished()) {
                $array = array_merge($array, array(
                    'State' => $entity->getState()->getName(),
                    'ImplementingSectorId' => $entity->getImplementingSector()->id(),
                    'ImplementingSectorName' => $entity->getImplementingSector()->getName(),
                    'CategoryId' => $entity->getCategory()->id(),
                    'CategoryName' => $entity->getCategory()->getName(),
                    'TypeId' => $entity->getType()->id(),
                    'TypeName' => $entity->getType()->getName(),
                    'WebsiteUrl' => $entity->getWebsiteUrl(),
                    'Administrator' => $entity->getAdministrator(),
                    'FundingSource' => $entity->getFundingSource(),
                    'Budget' => $entity->getBudget(),
                    'StartDate' => $entity->tsGetFormatted($entity->getStartDate(), 'm/d/Y'),
                    'EndDate' => $entity->tsGetFormatted($entity->getEndDate(), 'm/d/Y'),
                    'Utilities' => $entity->getUtilities(),
                    'Counties' => $entity->getCounties(),
                    'Cities' => $entity->getCities(),
                    'ZipCodes' => $entity->getZipCodes(),
                    'Technologies' => $entity->flatCollection($entity->getTechnologies(), true),
                    'Sectors' => $entity->flatCollection($entity->getSectors(), true),
                    'Contacts' => $entity->flatCollection($entity->getContacts(), true),
                    'ProgramParameters' => $entity->flatCollection($entity->getParameterSets(), true),
                    'Details' => $entity->flatCollection($entity->getDetails(), true),
                    'Authorities' => $entity->flatCollection($entity->getAuthorities(), true),
                ));
            }

            return $array;
        } else {
            return parent::process($entity, $params, $results, $asEntity);
        }
    }
}
