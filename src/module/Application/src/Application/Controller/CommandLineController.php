<?php

namespace Application\Controller;

use Application\Factory\Export as ExportFactory;
use FzyCommon\Util\Params;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mail;

class CommandLineController extends AbstractActionController
{
    public function migrateAction()
    {
        $params = Params::create($this->getEvent()->getRouteMatch()->getParams());
        /* @var $migrateService \Application\Service\Cli\Migrate\Base */
        $migrateService = $this->getServiceLocator()->get('Application\Service\Cli\Migrate');
        $migrateService->setTable($params->get('table'))->migrate($this->getServiceLocator()->get('FzyCommon\Config')->getWrapped('migration'));
    }

    public function exportAction()
    {
        $params = Params::create($this->getEvent()->getRouteMatch()->getParams());
        /* @var $exportService \Application\Service\Cli\Export\Base */
        $exportService = $this->getServiceLocator()->get('Application\Service\Cli\Export');
        $exportFactor = new ExportFactory();
        $type = $params->get('type');
        $subject = '';
        $body = '';
        try {
            $exportService->export($exportFactor->getExportUtil($type, $this->getServiceLocator()), $this->getServiceLocator()->get('FzyCommon\Config')->getWrapped('export'));
            $subject = 'DSIRE Database Export Successful';
        } catch (\Exception $e) {
            $subject = 'DSIRE Database Export Failed';
            $body = $e->getMessage();
        }
        //Send email to IT @ abt
        $mail = new Mail\Message();
        $mail->setBody($body);
        $mail->addTo('notify@atlanticbt.com', 'Notify');
        $mail->setSubject($subject);

        $transport = new Mail\Transport\Sendmail();
        $transport->send($mail);
    }
}
