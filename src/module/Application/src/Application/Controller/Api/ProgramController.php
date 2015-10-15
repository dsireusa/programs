<?php

/**
 * Zend Framework (http://framework.zend.com/).
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 *
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application\Controller\Api;

use Application\Entity\Base\Program;
use Application\Entity\Base\UserInterface;
use FzyCommon\Util\Params;
use Zend\Http\Response;
use Zend\View\Model\JsonModel;
use Zend\XmlRpc\Generator\DomDocument;

class ProgramController extends AbstractApiController
{
    /**
     * @return mixed
     */
    protected function getSearchServiceKey()
    {
        //by default only show published programs unless you are logged in as admin
        $searchServiceKey = 'programs_published';
        $sm = $this->getServiceLocator();
        $auth = $sm->get('zfcuser_auth_service');
        if ($auth->hasIdentity()  && $auth->getIdentity()->getRole() == UserInterface::ROLE_ADMIN) {
            $searchServiceKey = 'programs';
        }

        return $searchServiceKey;
    }

    /**
     * @return mixed
     */
    protected function getUpdateServiceKey()
    {
        return 'program';
    }

    public function byStateAction()
    {
        $params = $this->getParamsFromRequest();

        $model = $this->search($params, $this->getServiceLocator()->get('programs_by_state'));
        if ($params->has('callback')) {
            $model->setJsonpCallback($params->get('callback'));
        }

        return $model;
    }

    public function byTypeAction()
    {
        $params = $this->getParamsFromRequest();

        $model = $this->search($params, $this->getServiceLocator()->get('programs_by_type'));
        if ($params->has('callback')) {
            $model->setJsonpCallback($params->get('callback'));
        }

        return $model;
    }

    public function byTypeAndStateAction()
    {
        $params = $this->getParamsFromRequest();

        $typeModel = $this->getServiceLocator()->get('programs_by_type')->search($params)->getResults();
        $stateModel = $this->getServiceLocator()->get('programs_by_state')->search($params)->getResults();
        $model = new JsonModel(array($typeModel, $stateModel));
        if ($params->has('callback')) {
            $model->setJsonpCallback($params->get('callback'));
        }

        return $model;
    }

    public function createAction()
    {
        return $this->update($this->getParamsFromRequest(), $this->getServiceLocator()->get('program_create')->setEntity(new Program()));
    }

    public function newsAction()
    {
        $params = $this->getParamsFromRequest();
        $subscriptions = $this->search($params, $this->getServiceLocator()->get('memos_subscription_rss'));

        return $subscriptions;
    }

    /**
     *
     */
    public function authorityUploadAction()
    {
        $params = $this->getParamsFromRequest();
        $service = $this->getServiceLocator()->get('authority_upload');

        return $this->update($params, $service);
    }

    public function indexAction()
    {
        $params = $this->getParamsFromRequest();
        if ($params->has('city')) {
            $zipCodes = $this->getServiceLocator()->get('zipcodes')->search(Params::create(array('city' => $params->get('city')[0])))->getResults();
            $countyIds = array_unique(array_map(function ($e) {
                return is_array($e) && array_key_exists('county', $e) ? $e['county'] : null;
            }, $zipCodes));
            if ($countyIds) {
                $params->set('city-county', $countyIds);
            }
        }
        if ($params->has('zipcode')) {
            $zipCodes = $this->getServiceLocator()->get('zipcodes')->search(Params::create(array('id' => $params->get('zipcode')[0])))->getResults();
            if (!$params->has('state')) {
                $stateIds = array_unique(array_map(function ($e) {
                    return is_array($e) && array_key_exists('state', $e) ? $e['state'] : null;
                }, $zipCodes));
                if ($stateIds) {
                    $params->set('state', $stateIds);
                }
            }
            $countyIds = array_unique(array_map(function ($e) {
                return is_array($e) && array_key_exists('county', $e) ? $e['county'] : null;
            }, $zipCodes));
            if ($countyIds) {
                $params->set('zip-county', $countyIds);
            }
            $cityIds = array_unique(array_map(function ($e) {
                return is_array($e) && array_key_exists('city', $e) ? $e['city'] : null;
            }, $zipCodes));
            if ($cityIds) {
                $params->set('zip-city', $cityIds);
            }
            $utilities = $this->getServiceLocator()->get('utilities')->search(Params::create(array('zipcode' => $params->get('zipcode')[0])))->getResults();
            $utilityIds = array_map(function ($e) {
                return is_array($e) && array_key_exists('id', $e) ? $e['id'] : null;
            }, $utilities);
            if ($utilityIds) {
                $params->set('zip-utility', $utilityIds);
            }
        }
        if ($params->has('energycategory') || $params->has('technologycategory')) {
            $newParams = Params::create(array());
            if ($params->has('energycategory')) {
                $newParams->set('energyCategoryId', $params->get('energycategory')[0]);
            }
            if ($params->has('technologycategory')) {
                $newParams->set('technologyCategoryId', $params->get('technologycategory')[0]);
            }
            $technologies = $this->getServiceLocator()->get('technology_ids')->search($newParams)->getResults();
            $technologyIds = array_map(function ($e) {
                return is_array($e) && array_key_exists('id', $e) ? $e['id'] : null;
            }, $technologies);
            if (sizeof($technologyIds)) {
                $params->set('technology', array_unique(array_merge((array) $params->get('technology'), $technologyIds)));
            }
        }
        if ($params->has('sector')) {
            $sectors = $this->getServiceLocator()->get('sectors')->search(Params::create(array('id' => $params->get('sector'))), true)->getResults();
            $childSectorIds = array();
            foreach ($sectors as $sector) {
                $childSectorIds = array_merge($childSectorIds, $this->getChildSectorIds($sector));
            }
            $childSectorIds = array_unique($childSectorIds);
            if (sizeof($childSectorIds)) {
                $params->set('sector', $childSectorIds);
            }
        }

        return $this->search($params, $this->getSearchService($params));
    }
    //recursively traverse through sector parent-child relationships to retrieve the root sector id's below all given sectors
    protected function getChildSectorIds(Program\Sector $sector)
    {
        if ($sector->isSelectable()) {
            return array($sector->id());
        } else {
            $children = $sector->getChildren();
            $childrenIds = array();
            foreach ($children as $child) {
                $childrenIds = array_merge($childrenIds, $this->getChildSectorIds($child));
            }

            return $childrenIds;
        }
    }

    public function getProgramsByDateAction()
    {
        $params = $this->getParamsFromRequest();
        $params->set('updatedfrom', array($params->get('from')));
        $params->set('updatedto', array($params->get('to')));
        if ($params->has('format') && $params->get('format') == 'xml') {
            $response = new Response();
            $response->getHeaders()->addHeaderLine('Content-Type', 'text/xml; charset=utf-8');
            $response->setContent($this->getProgramsByDateAsXML($params));

            return $response;
        }

        return $this->search($params, $this->getServiceLocator()->get('get_programs_by_date'));
    }

    public function getProgramsByDateAsXML($params)
    {
        // initializing or creating array
        $programs = $this->getServiceLocator()->get('get_programs_by_date')->search($params)->getResults();
        // creating object of SimpleXMLElement
        $xmlPrograms = new DomDocument();
        $xmlPrograms->openElement('Programs');

        // function call to convert array to xml
        $this->array_to_xml($programs, 'Programs', $xmlPrograms);

        //saving generated xml file
        return $xmlPrograms->saveXML();
    }

    public function getProgramsAction()
    {
        $params = $this->getParamsFromRequest();
        if ($params->has('format') && $params->get('format') == 'xml') {
            $response = new Response();
            $response->getHeaders()->addHeaderLine('Content-Type', 'text/xml; charset=utf-8');
            $response->setContent($this->getProgramsAsXML());

            return $response;
        }

        return $this->search($params, $this->getServiceLocator()->get('get_programs'));
    }

    public function getProgramsAsXML()
    {
        // initializing or creating array
        $programs = $this->getServiceLocator()->get('get_programs')->search($this->getParamsFromRequest())->getResults();
        // creating object of SimpleXMLElement
        $xmlPrograms = new DomDocument();
        $xmlPrograms->openElement('Programs');

        // function call to convert array to xml
        $this->array_to_xml($programs, 'Programs', $xmlPrograms);

        //saving generated xml file
        return $xmlPrograms->saveXML();
    }

    // function definition to convert array to xml
    public function array_to_xml($programs, $parentName, DomDocument $xmlPrograms)
    {
        foreach ((array) $programs as $key => $value) {
            if (is_array($value)) {
                if (!is_numeric($key)) {
                    $xmlPrograms->openElement('_'.$key);
                    $this->array_to_xml($value, $key, $xmlPrograms);
                    $xmlPrograms->closeElement('_'.$key);
                } else {
                    $xmlPrograms->openElement('_'.$parentName.'_'.$key);
                    $this->array_to_xml($value, $key,  $xmlPrograms);
                    $xmlPrograms->closeElement('_'.$parentName.'_'.$key);
                }
            } else {
                $xmlPrograms->openElement('_'.$key, $value);
                $xmlPrograms->closeElement('_'.$key);
            }
        }
    }
}
