<?php

return array(
    'navigation' => array(
        'default' => array(
            'overview' => array(
                'label' => 'Overview',
                'route' => 'home/system/program',
                'resource' => \FzyAuth\Service\AclEnforcerInterface::RESOURCE_CONTROLLER_PREFIX . 'Application\Controller\Program',
                'privilege' => 'index',
                 // 'pages' => array(),
            ),
            
            'summarymaps' => array(
                'label' => 'Summary Maps',
                'route' => 'home',
                'route' => 'home/system/program',
                'action' => 'maps',
                'resource' => \FzyAuth\Service\AclEnforcerInterface::RESOURCE_CONTROLLER_PREFIX . 'Application\Controller\Program',
                'privilege' => 'index',
//                'pages' => array(),
            ),
            'summarytables' => array(
                'label' => 'Summary Tables',
                'route' => 'home/system/program',
                'action' => 'tables',
                'resource' => \FzyAuth\Service\AclEnforcerInterface::RESOURCE_CONTROLLER_PREFIX . 'Application\Controller\Program',
                'privilege' => 'index',
//                'pages' => array(),
            ),
            'news' => array(
                'label' => 'News',
                'route' => 'home/system/program',
                'action' => 'news',
                'resource' => \FzyAuth\Service\AclEnforcerInterface::RESOURCE_CONTROLLER_PREFIX . 'Application\Controller\Program',
                'privilege' => 'index',
//                'pages' => array(),
            ),
            'newprogram' => array(
                'label' => 'Create New Program',
                'route' => 'home/system/program',
                'params' => array('action' => 'new'),
                'resource' => \FzyAuth\Service\AclEnforcerInterface::RESOURCE_CONTROLLER_PREFIX . 'Application\Controller\Program',
                'privilege' => 'new',
//                'pages' => array(),
            ),
            'users' => array(
                'label' => 'Contacts',
                'route' => 'home/system/contact',
                'resource' => \FzyAuth\Service\AclEnforcerInterface::RESOURCE_ROUTE_PREFIX . 'home/system/contact',
                'privilege' => 'index',
//                'pages' => array(),
            ),
            'contacts' => array(
                'label' => 'Users',
                'route' => 'home/system/user',
                'resource' => \FzyAuth\Service\AclEnforcerInterface::RESOURCE_ROUTE_PREFIX . 'home/system/user',
                'privilege' => 'index',
//                'pages' => array(),
            ),
        ),
    ),
);
