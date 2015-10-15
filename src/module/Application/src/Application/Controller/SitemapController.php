<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class SitemapController extends AbstractActionController
{
    public function indexAction()
    {
        $acl = $this->getServiceLocator()->get('FzyAuth\Acl');
        $role = $this->getServiceLocator()->get('FzyAuth\CurrentUser')->getRole();
        $viewModel = new ViewModel(array(
            'acl' => $acl,
            'role' => $role,
        ));

        return $viewModel;
    }

    public function xmlAction()
    {
        // Explicitly set type to text/xml, otherwise it's text/html
        $this->getResponse()->getHeaders()->addHeaderLine(
            'Content-Type', 'text/xml'
        );

        // Only render the sitemap helper, without any layout
        $acl = $this->getServiceLocator()->get('FzyAuth\Acl');
        $role = $this->getServiceLocator()->get('FzyAuth\CurrentUser')->getRole();
        $viewModel = new ViewModel(array(
            'acl' => $acl,
            'role' => $role,
        ));
        $viewModel->setTerminal(true);

        return $viewModel;
    }
}
