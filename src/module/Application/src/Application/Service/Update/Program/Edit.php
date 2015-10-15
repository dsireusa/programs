<?php

namespace Application\Service\Update\Program;

use Application\Entity\Base\Parameter\Set;
use Application\Entity\Base\ParameterInterface;
use Application\Entity\Base\Program\Authority;
use Application\Entity\Base\Program\Memo as ProgramMemo;
use Application\Entity\Base\Program\Sector;
use Application\Entity\Base\Subscription\Memo as SubscriptionMemo;
use Application\Entity\Base\MemoInterface;
use Application\Entity\Base\ProgramInterface;
use Application\Service\Search\Base\DQL\Program;
use Application\Service\Update\Program as UpdateService;
use FzyCommon\Util\Params;
use Zend\EventManager\Event;
use Zend\Form\Form;

/**
 * Class Edit.
 */
class Edit extends UpdateService
{
    /**
     * @param array $entities
     */
    protected function beforeFormGeneration(array $entities)
    {
        $this->getEventManager()->attach(static::EVENT_CONFIGURE_FORM.static::MAIN_TAG, function (Event $event) {
            /* @var $form \Zend\Form\Form */
            $form = $event->getParam('form');
            $form->remove('entireState')->remove('state')->remove('implementingSector')->remove('category')->remove('type')->remove('code');
            $form->setOption('params_sources', array(
                ParameterInterface::SOURCE_OPTION_SYSTEM,
                ParameterInterface::SOURCE_OPTION_INCENTIVE,
            ))->setOption('params_qualifiers', array(
                ParameterInterface::QUALIFIER_OPTION_VALUE_IS => 'Is',
                ParameterInterface::QUALIFIER_OPTION_VALUE_MIN => 'Min',
                ParameterInterface::QUALIFIER_OPTION_VALUE_MAX => 'Max',
            ))->setOption('params_units', array(
                ParameterInterface::SOURCE_OPTION_SYSTEM => array(
                    'default' => array(
                        '$',
                    ),
                    ParameterInterface::QUALIFIER_OPTION_VALUE_MIN => array(
                        'W',
                        'kW',
                        'kW-AC',
                        'kW-DC',
                        'kW-CEC-AC',
                        'MW',
                        'Square Feet',
                        'Tons',
                        'Horsepower',
                        'Gallons',
                        'Therms',
                        'BTU/day',
                        'kWh annual savings',
                    ),
                    ParameterInterface::QUALIFIER_OPTION_VALUE_MAX => array(
                        'W',
                        'kW',
                        'kW-AC',
                        'kW-DC',
                        'kW-CEC-AC',
                        'MW',
                        'Square Feet',
                        'Tons',
                        'Horsepower',
                        'Gallons',
                        'Therms',
                        'BTU/day',
                        'kWh annual savings',
                        '% of monthly demand',
                        '% of annual demand',
                    ),
                ),
                ParameterInterface::SOURCE_OPTION_INCENTIVE => array(
                    'default' => array(
                        '$/Unit',
                        '$/W',
                        '$/W-DC',
                        '$/W-AC',
                        '$/W-CEC-AC',
                        '$/kW',
                        '$/kWh',
                        '$/kWh (1 year)',
                        '$/kWh (4 years)',
                        '$/kWh (5 years)',
                        '$/kWh (10 years)',
                        '$/kWh (15 years)',
                        '$/kWh (20 years)',
                        '$/MWh',
                        '$/kW peak demand reduction',
                        '$/first year kWh savings',
                        '%',
                        '$/ton',
                        '$/fixture',
                        '$/bulb',
                        '$/lamp',
                        '$/square foot',
                        '$/linear foot',
                        '$/therm',
                        '$/therm displaced',
                        '$/gallon',
                        '$/horsepower',
                        '$/motor',
                        '$/BTU',
                        '$/MBTUh',
                    ),
                    ParameterInterface::QUALIFIER_OPTION_VALUE_MAX => array(
                        '$',
                        '% of cost',
                        'Years',
                    ),
                ),
            ));
        });
        parent::beforeFormGeneration($entities);
    }

    public function update(Params $params, $options = array())
    {
        // timeouts keep happening
        set_time_limit(0);

        return parent::update($params, $options);
    }

    /**
     * @param bool   $valid
     * @param Params $params
     */
    protected function postValidate($valid, Params $params, $options = array())
    {
        /* @var $program \Application\Entity\Base\Program */
        $program = $this->entity();
        if ($valid) {
            // don't put a success message in session
            $this->setUseSessionMessage(false);
            if ($params->has('setLastUpdated') && $params->get('setLastUpdated')) {
                $program->setUpdatedTs('now');
            }
            $this->addMemos($program, $params)
                ->addCites($program, $params)
                ->addCounties($program, $params)
                ->addZipCodes($program, $params)
                ->addUtilities($program, $params)
                ->addAuthorities($program, $params)
                ->addContacts($program, $params)
                ->addDetails($program, $params)
                ->addSectors($program, $params)
                ->addTechnologies($program, $params)
                ->addParameters($program, $params);
        }

        return parent::postValidate($this->valid, $params, $options);
    }

    protected function addSectors(ProgramInterface $program, Params $params)
    {
        // remove all sectors from this program
        $program->clearSectors();
        // get sector data posted
        $data = $params->get('sectors', array());
        $entityName = 'Application\Entity\Base\Program\Sector';
        $repo = $this->em()->getRepository($entityName);
        foreach ($data as $sectorData) {
            if (!isset($sectorData['id'])) {
                // create a new sector
                if (!trim($sectorData['name']) || empty($sectorData['parentId'])) {
                    continue;
                }
                // look up parent
                $parent = $repo->find($sectorData['parentId']);
                $sector = new Sector();
                $sector->setName($sectorData['name'])
                    ->setParent($parent)
                    ->setSelectable(true);
                $this->em()->persist($sector);
                // add new sector to this program
                $sector->addProgram($program);
            }
        }

        return $this->addProgramToHasMultiEntity($program, $data, $entityName);
    }

    protected function addCites(ProgramInterface $program, Params $params)
    {
        // remove all cities from program
        $program->clearCities();

        return $this->addProgramToHasMultiEntity($program, $params->get('cities', array()), 'Application\Entity\Base\Program\City');
    }

    protected function addCounties(ProgramInterface $program, Params $params)
    {
        // remove all cities from program
        $program->clearCounties();

        return $this->addProgramToHasMultiEntity($program, $params->get('counties', array()), 'Application\Entity\Base\Program\County');
    }

    protected function addContacts(ProgramInterface $program, Params $params)
    {
        // handle removals
        $this->removeEntitiesNotPresent($params, 'contacts', $program->getContacts())
            // handle updates and creations
            ->addProgramToHasProgramEntity($program, $params, 'program_contact', 'program_contacts', 'contacts');

        return $this;
    }

    protected function addZipCodes(ProgramInterface $program, Params $params)
    {
        // remove all cities from program
        $program->clearZipCodes();

        return $this->addProgramToHasMultiEntity($program, $params->get('zipcodes', array()), 'Application\Entity\Base\Utility\ZipCode');
    }

    /**
     * @param ProgramInterface $program
     * @param Params           $params
     *
     * @return Edit
     */
    protected function addUtilities(ProgramInterface $program, Params $params)
    {
        // remove all utilities from program
        $program->clearUtilities();
        // iterate over utilities attached.
        return $this->addProgramToHasMultiEntity($program, $params->get('utilities', array()), 'Application\Entity\Base\Utility');
    }

    /**
     * Attach a program to a HasMultiProgramInterface object.
     * Only use the ids to match up existing.
     *
     * @param ProgramInterface $program
     * @param array            $data
     * @param $entityName
     *
     * @return $this
     */
    protected function addProgramToHasMultiEntity(ProgramInterface $program, array $data, $entityName)
    {
        // get all non-null ids from param data
        $ids = array_filter(array_map(function ($data) {return isset($data['id']) ? $data['id'] : null;}, $data));
        // get this entity's repo
        $entities = array();
        if (!empty($ids)) {
            $qb = $this->em()->getRepository($entityName)->createQueryBuilder('e');
            // look up all instances of this entity with this id
            $query = $qb->andWhere($qb->expr()->in('e.id', $ids))->getQuery();
            $entities = $query->getResult();
                /* @var $entity \Application\Entity\Base\HasMultiProgramInterface */
                foreach ($entities as $entity) {
                    // attach program
                    $entity->addProgram($program);
                }
        }

        return $this;
    }

    protected function addTechnologies(ProgramInterface $program, Params $params)
    {
        // remove all cities from program
        $program->clearTechnologies();

        return $this->addProgramToHasMultiEntity($program, $params->get('technologies', array()), 'Application\Entity\Base\Technology');
    }

    protected function addDetails(ProgramInterface $program, Params $params)
    {
        $this->removeEntitiesNotPresent($params, 'details', $program->getDetails());

        return $this->addProgramToHasProgramEntity($program, $params, 'detail', 'details', 'details');
    }

    /**
     * @param ProgramInterface $program
     * @param Params           $params
     *
     * @return $this
     */
    protected function addAuthorities(ProgramInterface $program, Params $params)
    {
        $this->removeEntitiesNotPresent($params, 'authorities', $program->getAuthorities());

        return $this->addProgramToHasProgramEntity($program, $params, 'authority', 'authorities', 'authorities');
    }

    protected function addProgramToHasProgramEntity(ProgramInterface $program, Params $params, $updateServiceKey, $searchServiceKey, $dataParamName)
    {
        // iterate over cities attached.
        $index = 0;
        /* @var $service \Application\Service\Update\Base */
        $service = $this->getServiceLocator()->get($updateServiceKey);
        // don't put any success messages into the session
        $service->setUseSessionMessage(false);
        /* @var $search \Application\Service\Search\Base\DQL */
        $search = $this->getServiceLocator()->get($searchServiceKey);
        foreach ($params->get($dataParamName, array()) as $data) {
            $p = Params::create($data);
            $service->reset();
            $p->set($service::MAIN_ENTITY_ID_PARAM, $p->get('id'));
            $service->setMainEntityFromParam($p, $search);
            $service->entity()->setProgram($program);
            $service->update($p, array(self::OPTION_NO_FLUSH => true));
            if (!$service->getValid()) {
                $this->valid = false;
                $messages = $service->getErrorMessages();
                $this->errorMessages[$service::MAIN_TAG.$index] = $messages[$service::MAIN_TAG];
            }
            ++$index;
        }

        return $this;
    }

    /**
     * Adds parameter sets.
     *
     * @param ProgramInterface $program
     * @param Params           $params
     */
    protected function addParameters(ProgramInterface $program, Params $params)
    {
        return $this->removeEntitiesNotPresent($params, 'parameterSets', $program->getParameterSets())
            ->addProgramToHasProgramEntity($program, $params, 'parameter_set', 'parameter_sets', 'parameterSets');
    }

    /**
     * Searches params for new program/subscription memos. Adds new entities if present.
     *
     * @param ProgramInterface $program
     * @param Params           $params
     *
     * @return $this
     */
    protected function addMemos(ProgramInterface $program, Params $params)
    {
        $this->createAndAttachMemo($program, $params, 'newProgramMemo', new ProgramMemo());
        $this->createAndAttachMemo($program, $params, 'newSubscriptionMemo', new SubscriptionMemo());

        return $this;
    }

    /**
     * If the specified parameter is present and not empty, create a new memo
     * instance and attach to the program.
     *
     * @param ProgramInterface $program
     * @param Params           $params
     * @param $memoTextKey
     * @param MemoInterface $memo
     * @param $attachCallable
     *
     * @return $this
     */
    protected function createAndAttachMemo(ProgramInterface $program, Params $params, $memoTextKey, MemoInterface $memo, $attachCallable = null)
    {
        if ($memoText = trim($params->get($memoTextKey))) {
            // create a new memo and attach it to the program
            $memo->setMemo($memoText)->setAddedByUser($this->getCurrentUser())->setDateAddedTS('now')->setProgram($program);
            if (is_callable($attachCallable)) {
                call_user_func_array($attachCallable, array($program, $memo));
            }
            $this->em()->persist($memo);
        }

        return $this;
    }

    /**
     * Removes any entites currently present that were not posted with the new data.
     *
     * @param Params $params
     * @param $key
     * @param $entities
     *
     * @return $this
     */
    protected function removeEntitiesNotPresent(Params $params, $key, $entities)
    {
        $ids = array_filter(array_map(function ($data) {return isset($data['id']) ? $data['id'] : null;}, $params->get($key, array())));
        // check set for these ids
        $em = $this->em();
        /* @var $entity \Application\Entity\Base */
        foreach ($entities as $entity) {
            if (!in_array($entity->id(), $ids)) {
                // delete the relation.
                $em->remove($entity);
            }
        }

        return $this;
    }
}
