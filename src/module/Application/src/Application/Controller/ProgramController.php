<?php

namespace Application\Controller;

use Application\Entity\Base\Contact;
use Application\Entity\Base\Program\Authority;
use FzyCommon\Exception\Search\NotFound;
use FzyCommon\Util\Params;
use Zend\View\Model\ViewModel;

class ProgramController extends AbstractWebController
{
    const STATE_FILTER_TO_TERRITORIES = 'TER';
    protected function getSearchServiceKey()
    {
        return 'programs';
    }

    protected function getUpdateServiceKey()
    {
        return 'program';
    }

    public function newAction()
    {
        $params = $this->getParamsFromRequest();

        /* @var $sectorService \Application\Service\Search\Base\DQL\ImplementingSector */
        $sectorService = $this->getServiceLocator()->get('implementing_sectors');
        /* @var $categoryService \Application\Service\Search\Base\DQL\Category */
        $categoryService = $this->getServiceLocator()->get('categories');

        return new ViewModel(array(
            'implementingSectors' => $sectorService->search($params)->getResults(),
            'categories' => $categoryService->search($params)->getResults(),
        ));
    }

    public function detailAction()
    {
        $params = $this->getParamsFromRequest();
        $service = $this->getSearchService($params);
        try {
            $program = $service->identitySearch($params);
        } catch (NotFound $e) {
            $this->flashMessenger()->addErrorMessage('That program does not exist.');

            return $this->redirect()->toRoute('home');
        }

        return new ViewModel(array(
            'entity' => $program,
            'programLastUpdated' => $program->getUpdatedTs()->format('F j, Y'),
            'technologiesByEnergyCategory' => $program->getTechnologiesByEnergyCategory(),
            'sectors' => $program->getSectors(),
            'utilities' => $program->getUtilities(),
            'counties' => $program->getCounties(),
            'cities' => $program->getCities(),
            'zipCodes' => $program->getZipCodes(),
            'details' => $program->getDetails(),
            'parameterSets' => $program->getParameterSets(),
            'authorities' => $program->getAuthorities(),
            'contacts' => $program->getContacts(),
            'subscribeToProgramUrl' => $this->getServiceLocator()->get('FzyCommon\Service\Url')->fromRoute('home/rss/get/action', array('action' => 'program', 'searchId' => $program->id()), array('force_canonical' => true)),
        ));
    }

    public function editAction()
    {
        $view = parent::editAction();
        /* @var $program \Application\Entity\Base\Program */
        $program = $view->getVariable('entity');
        if (!$program->id()) {
            $this->flashMessenger()->addErrorMessage('That program does not exist.');

            return $this->redirect()->toRoute('home');
        }

        // for the new contact form
        /* @var $contactService \Application\Service\Update\Contact */
        $contactService = $this->getServiceLocator()->get('contact');
        $contactService->setEntity(new Contact());
        /* @var $authorityService \Application\Service\Update\Authority */
        $authorityService = $this->getServiceLocator()->get('authority');
        $authorityService->setEntity(new Authority());

        $view->setVariables(array(
            'contactEntity' => $contactService->entity(),
            'contactForm' => $contactService->form(),
            'energyCategories' => $this->getServiceLocator()->get('energy_categories')->search(Params::create(), true)->getResults(),
            'sectors' => $this->getServiceLocator()->get('sectors_map')->search(Params::create(array('parentId' => null)))->getResults(),
            'detailTemplates' => $this->getServiceLocator()->get('details_templates')->search(Params::create(array(
                'programTypeId' => $program->getType()->id(),
            )))->getResults(),
            'authorityForm' => $authorityService->form(),
        ));

        return $view;
    }

    public function indexAction()
    {
        $params = $this->getParamsFromRequest();
        $sm = $this->getServiceLocator();
        $auth = $sm->get('zfcuser_auth_service');
        $initParams = array('role' => 'guest', 'initFilters' => array());
        if ($auth->getIdentity()) {
            $initParams['role'] = $auth->getIdentity()->getRole();
        }

        if ($params->has('technology')) {
            $technology = $this->getServiceLocator()->get('technologies')->search(Params::create(array('technologyId' => $params->get('technology'))))->getResults();
            if ($technology) {
                $initParams['initFilters']['technology'] = $technology[0];
            }
        }
        if ($params->has('category')) {
            $category = $this->getServiceLocator()->get('categories')->search(Params::create(array('categoryId' => $params->get('category'))))->getResults();
            if ($category) {
                $initParams['initFilters']['category'] = $category[0];
            }
        }
        if ($params->has('type')) {
            $type = $this->getServiceLocator()->get('types')->search(Params::create(array('typeId' => $params->get('type'))))->getResults();
            if ($type) {
                $initParams['initFilters']['type'] = $type[0];
            }
        }
        if ($params->has('implementingsector')) {
            $implementingSector = $this->getServiceLocator()->get('implementing-sectors')->search(Params::create(array('implementingSectorId' => $params->get('implementingsector'))))->getResults();
            if ($implementingSector) {
                $initParams['initFilters']['implementingsector'] = $implementingSector[0];
            }
        }
        if ($params->has('state')) {
            if (strtoupper($params->get('state')) == self::STATE_FILTER_TO_TERRITORIES) {
                $initParams['initFilters']['territories'] = array('name' => 'All', 'id' => 1);
            } else {
                $params->set('abbreviation', $params->get('state'));
                $params->remove('state');
                $state = $this->getServiceLocator()->get('states')->search($params)->getResults();
                if ($state) {
                    $initParams['initFilters']['state'] = $state[0];
                }
            }
        }
        if ($params->has('utility')) {
            $utility = $this->getServiceLocator()->get('utilities')->search(Params::create(array('utilityId' => $params->get('utility'))))->getResults();
            if ($utility) {
                $initParams['initFilters']['utility'] = $utility[0];
            }
        }
        if ($params->has('county')) {
            $county = $this->getServiceLocator()->get('counties')->search(Params::create(array('countyId' => $params->get('county'))))->getResults();
            if ($county) {
                $initParams['initFilters']['county'] = $county[0];
            }
        }
        if ($params->has('city')) {
            $city = $this->getServiceLocator()->get('cities')->search(Params::create(array('cityId' => $params->get('city'))))->getResults();
            if ($city) {
                $initParams['initFilters']['city'] = $city[0];
            }
        }
        if ($params->has('zipcode')) {
            $zipCode = $this->getServiceLocator()->get('zipcodes')->search(Params::create(array('zipcode' => $params->get('zipcode'))))->getResults();
            if ($zipCode) {
                $initParams['initFilters']['zipcode'] = $zipCode[0];
            }
        }
        if ($params->has('sector')) {
            $sector = $this->getServiceLocator()->get('sectors')->search(Params::create(array('sectorId' => $params->get('sector'))))->getResults();
            if ($sector) {
                $initParams['initFilters']['sector'] = $sector[0];
            }
        }
        $initParams['subscribeToAllProgramsUrl'] = $this->getServiceLocator()->get('FzyCommon\Service\Url')->fromRoute('home/rss/get/action', array('action' => ''), array('force_canonical' => true));

        return new ViewModel($initParams);
    }

    public function tablesAction()
    {
        $params = $this->getParamsFromRequest()->set('limit', 100);
        $modelParams = array(
            'programs-by-type' => $this->getServiceLocator()->get('programs-by-type')->search($params)->getResults(),
            'programs-by-state' => $this->getServiceLocator()->get('programs-by-state')->search($params)->getResults(),
        );
        if ($params->has('category')) {
            $modelParams['category'] = $this->getServiceLocator()->get('categories')->search(Params::create(array('categoryId' => $params->get('category'))))->getResult();
        }
        if ($params->has('technology')) {
            $modelParams['technology'] = $this->getServiceLocator()->get('technologies')->search(Params::create(array('technologyId' => $params->get('technology'))))->getResult();
        }

        return new ViewModel($modelParams);
    }

    public function mapsAction()
    {
        $params = $this->getParamsFromRequest()->set('limit', 100);
        $modelParams = array(
            'programs-by-state' => $this->getServiceLocator()->get('programs-by-state')->search($params)->getResults(),
        );
        if ($params->has('type')) {
            $modelParams['type'] = $this->getServiceLocator()->get('types')->search(Params::create(array('typeId' => $params->get('type'))))->getResult();
        }
        if ($params->has('technology')) {
            $modelParams['technology'] = $this->getServiceLocator()->get('technologies')->search(Params::create(array('technologyId' => $params->get('technology'))))->getResult();
        }

        return new ViewModel($modelParams);
    }

    public function newsAction()
    {
        $params = $this->getParamsFromRequest();
        $model = $this->getServiceLocator()->get('memos_subscription_rss')->search(Params::create(array()))->getResults();

        return new ViewModel(array('programUpdates' => $model, 'subscribeToAllProgramsUrl' => $this->getServiceLocator()->get('FzyCommon\Service\Url')->fromRoute('home/rss/get/action', array('action' => ''), array('force_canonical' => true))));
    }
}
