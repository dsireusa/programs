<?php
return array(
	'system' => array(
		'type' => 'literal',
		'options' => array(
			'route' => 'system',
		),
		'may_terminate' => true,
		'child_routes' => array(
			'user' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/user[/[:action[/:userId]]]',
					'constraints' => array(
						'userId' => '\d+',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
					),
					'defaults' => array(
						'controller' => 'Application\Controller\User',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
			),
			'contact' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/contact[/[:action[/:contactId]]]',
					'constraints' => array(
						'contactId' => '\d+',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
					),
					'defaults' => array(
						'controller' => 'Application\Controller\Contact',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
			),
			'program' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/program[/[:action[/:programId]]]',
					'constraints' => array(
						'programId' => '\d+',
						'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
					),
					'defaults' => array(
						'controller' => 'Application\Controller\Program',
						'action' => 'index',
					),
				),
				'may_terminate' => true,
			),
		),
	),
    'rss' => array(
        'type' => 'segment',
        'options' => array(
            'route' => 'rss[/]',
            'constraints' => array(
                'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
                'programId' => '\d+',
            ),
            'defaults' => array(
                'controller' => 'Application\Controller\Rss',
                'action' => 'all',
            ),
        ),
        'may_terminate' => true,
        'child_routes' => array(
            'get' => array(
                'type' => 'method',
                'options' => array(
                    'verb' => 'get',
                    'defaults' => array(
                        'action' => 'all',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'action' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => ':action[/:searchId]',
                        ),
                        'may_terminate' => true,

                    ),
                ),
            ),
        ),
    ),
);