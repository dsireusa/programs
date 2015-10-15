<?php

namespace Application\Controller;

use FzyCommon\Util\Params;
use Zend\Feed\Writer\Feed;

class RssController extends AbstractWebController
{
    const RSS_FEED_ALL_PROGRAM_TITLE = 'All Programs Feed';
    const RSS_FEED_ALL_PROGRAM_DESCRIPTION = 'Our RSS feeds provide a brief summary of what has changed with specific programs every time we update them. The All Programs feed allows you to keep up with every policy and incentive in DSIRE.';
    const RSS_FEED_SINGLE_PROGRAM_TITLE = 'Program Feed';
    const RSS_FEED_SINGLE_PROGRAM_DESCRIPTION = 'Our RSS feeds provide a brief summary of what has changed with specific programs every time we update them. This program feed allows you to keep up with this individual policy or incentive.';
    const RSS_FEED_PROGRAM_BY_STATE_TITLE = 'Programs Feed';
    const RSS_FEED_PROGRAM_BY_STATE_DESCRIPTION = 'Our RSS feeds provide a brief summary of what has changed with specific programs every time we update them. The State Programs feed allows you to keep up with every policy and incentive in the state of your choosing.';

    public function getSearchServiceKey()
    {
        return 'memos_subscription_rss';
    }

    public function getUpdateServiceKey()
    {
        return 'memos_subscription';
    }

    public function allAction()
    {
        $params = $this->getParamsFromRequest();
        $subscriptions = $this->getSearchService($params)->search($params, true)->getResults();
        $feed = $this->getFeed(self::RSS_FEED_ALL_PROGRAM_TITLE, self::RSS_FEED_ALL_PROGRAM_DESCRIPTION);
        $feed = $this->addProgramItems($feed, $subscriptions);

        return $this->getFeedResponse($feed);
    }

    public function programAction()
    {
        $params = $this->getParamsFromRequest();
        $programs = $this->getServiceLocator()->get('programs')->search(Params::create(array('programId' => $params->get('searchId'))), true)->getResults();
        if ($programs) {
            $programName = $programs[0]->getName().' ';
        } else {
            $programName = '';
        }
        if ($params->has('searchId')) {
            $params->set('programId', $params->get('searchId'));
            $params->remove('searchId');
        }
        $subscriptions = $this->getSearchService($params)->search($params, true)->getResults();
        $feed = $this->getFeed($programName.self::RSS_FEED_SINGLE_PROGRAM_TITLE, self::RSS_FEED_SINGLE_PROGRAM_DESCRIPTION);
        $feed = $this->addProgramItems($feed, $subscriptions);

        return $this->getFeedResponse($feed);
    }

    public function stateAction()
    {
        $params = $this->getParamsFromRequest();
        $subscriptions = array();
        if ($params->has('searchId') && !is_numeric($params->get('searchId'))) {
            $params->set('abbreviation', $params->get('searchId'));
        } else {
            $params->set('stateId', $params->get('searchId'));
        }
        $params->remove('searchId');
        $states = $this->getServiceLocator()->get('states')->search($params, true)->getResults();
        $stateAbbreviation = $states ? $states[0]->getAbbreviation() : 'State';
        if ($states) {
            $params->set('state', $states[0]->id());
            $programs = $this->getServiceLocator()->get('program_published_ids')->search($params)->getResults();
            $programIds = array_map(function ($e) {
                return is_array($e) && array_key_exists('id', $e) ? $e['id'] : null;
            }, $programs);
            if ($programIds) {
                $params->set('programIds', $programIds);
                $subscriptions = $this->getSearchService($params)->search($params, true)->getResults();
            }
        }
        $feed = $this->getFeed($stateAbbreviation.' '.self::RSS_FEED_PROGRAM_BY_STATE_TITLE, self::RSS_FEED_PROGRAM_BY_STATE_DESCRIPTION);
        if ($subscriptions) {
            $this->addProgramItems($feed, $subscriptions);
        }

        return $this->getFeedResponse($feed);
    }

    protected function getFeed($feedTitle, $feedDescription)
    {
        $feed = new Feed();
        $feed->setTitle($feedTitle);
        $feed->setLink($this->url()->fromRoute('home', array(), array('force_canonical' => true)));
        $feed->setDescription($feedDescription);

        return $feed;
    }

    protected function addProgramItems($feed, $subscriptions)
    {
        if (count($subscriptions) > 0) {
            foreach ($subscriptions as $sub) {
                $program = $sub->getProgram();
                $entry = $feed->createEntry();
                $entry->setTitle('Updated '.$program->getCode().': '.$program->getName());
                $entry->setLink($this->url()->fromRoute('home/system/program', array('action' => 'detail', 'programId' => $program->id()), array('force_canonical' => true)));
                $entry->setDescription($sub->getMemo());
                $entry->setDateCreated($sub->getDateAddedTS());
                $feed->addEntry($entry);
            }
        }

        return $feed;
    }

    protected function getFeedResponse($feed, $format = 'rss')
    {
        $response = new \Zend\Http\Response();
        $response->getHeaders()->addHeaderLine('Content-Type', 'application/rss+xml; charset=ISO-8859-1');
        $response->setContent($feed->export($format));

        return $response;
    }
}
