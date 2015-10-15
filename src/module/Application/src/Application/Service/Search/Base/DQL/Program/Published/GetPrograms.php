<?php

namespace Application\Service\Search\Base\DQL\Program\Published;

use FzyCommon\Util\Params;
use Application\Entity\Base\Program;

class GetPrograms extends Ids
{
    public function getLimit()
    {
        //no limit
    }

    /**
     * @param Program            $entity
     * @param Params             $params
     * @param array|\Traversable $results
     * @param bool               $asEntity
     *
     * @return array
     */
    protected function process($entity, Params $params, $results, $asEntity = false)
    {
        $object = parent::process($entity, $params, $results, $asEntity);
        if (!$asEntity) {
            return array(
                'ProgramId' => $entity->id(),
                'Code' => $entity->getCode(),
                'State' => $entity->getState()->getName(),
                'ImplementingSectorId' => $entity->getImplementingSector()->id(),
                'ImplementingSectorName' => $entity->getImplementingSector()->getName(),
                'CategoryId' => $entity->getCategory()->id(),
                'CategoryName' => $entity->getCategory()->getName(),
                'TypeId' => $entity->getType()->id(),
                'TypeName' => $entity->getType()->getName(),
                'Name' => $entity->getName(),
                'LastUpdate' => $entity->tsGetFormatted($entity->getUpdatedTS(), 'm/d/Y'),
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
                'Summary' => $entity->getSummary(),
            );
        } else {
            return parent::process($entity, $params, $results, $asEntity);
        }
    }
}
