<?php
return array(
	'users' => array(
		'type' => 'segment',
		'options' => array(
			'route' => '/users[/:userId]',
			'constraints' => array(
				'userId' => '\d+',
			),
			'defaults' => array(
				'controller' => 'Application\Controller\Api\User',
			),
		),
		'child_routes' => array(
			'get' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'get',
					'defaults' => array(
						'action' => 'index',
					),
				),
				'may_terminate' => true,
			),
			'post' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'post',
					'defaults' => array(
						'action' => 'update',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'action' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/:action',
							'constraints' => array(
								'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
							),
						),
						'may_terminate' => true,
					),
				),
			),
		),
	),
	'exports' => array(
		'type' => 'literal',
		'options' => array(
			'route' => '/exports',
			'defaults' => array(
				'controller' => 'Application\Controller\Api\Export',
				'action' => 'index',
			),
		),
		'may_terminate' => true,
	),
	'states' => array(
		'type' => 'literal',
		'options' => array(
			'route' => '/states',
			'defaults' => array(
				'controller' => 'Application\Controller\Api\State',
				'action' => 'index',
			),
		),
		'may_terminate' => true,
	),
    'territories' => array(
        'type' => 'literal',
        'options' => array(
            'route' => '/territories',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\State',
                'action' => 'territories',
            ),
        ),
        'may_terminate' => true,
    ),
	'types' => array(
		'type' => 'literal',
		'options' => array(
			'route' => '/types',
			'defaults' => array(
				'controller' => 'Application\Controller\Api\Type',
				'action' => 'index',
			),
		),
		'may_terminate' => true,
	),
	'implementing-sectors' => array(
		'type' => 'literal',
		'options' => array(
			'route' => '/implementing-sectors',
			'defaults' => array(
				'controller' => 'Application\Controller\Api\ImplementingSector',
				'action' => 'index',
			),
		),
	),
	'categories' => array(
		'type' => 'literal',
		'options' => array(
			'route' => '/categories',
			'defaults' => array(
				'controller' => 'Application\Controller\Api\Category',
				'action' => 'index',
			),
		),
	),
    'types' => array(
        'type' => 'literal',
        'options' => array(
            'route' => '/types',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\Type',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
    ),
    'utilities' => array(
        'type' => 'segment',
        'options' => array(
            'route' => '/utilities[/[:action]]',
            'constraints' => array(
                'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
            ),
            'defaults' => array(
                'controller' => 'Application\Controller\Api\Utility',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
    ),
    'counties' => array(
        'type' => 'literal',
        'options' => array(
            'route' => '/counties',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\County',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
    ),
    'cities' => array(
        'type' => 'literal',
        'options' => array(
            'route' => '/cities',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\City',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
    ),
    'zip-codes' => array(
        'type' => 'literal',
        'options' => array(
            'route' => '/zip-codes',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\ZipCode',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
    ),
    'sectors' => array(
        'type' => 'literal',
        'options' => array(
            'route' => '/sectors',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\Sector',
                'action' => 'index',
            ),
        ),
        'may_terminate' => true,
    ),
	'roles' => array(
		'type' => 'literal',
		'options' => array(
			'route' => '/roles',
			'defaults' => array(
				'controller' => 'Application\Controller\Api\Role',
				'action' => 'index',
			),
		),
	),
	'contacts' => array(
		'type' => 'segment',
		'options' => array(
			'route' => '/contacts[/:contactId]',
			'constraints' => array(
				'contactId' => '\d+',
			),
			'defaults' => array(
				'controller' => 'Application\Controller\Api\Contact',
				'action' => 'index',
			),
		),
		'child_routes' => array(
			'get' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'get',
					'defaults' => array(
						'action' => 'index',
					),
				),
				'may_terminate' => true,
			),
			'post' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'post',
					'defaults' => array(
						'action' => 'update',
					),
				),
				'may_terminate' => true,
			),
		),
	),
    'getprograms' => array(
        'type' => 'segment',
        'options' => array(
            'route' => '/getprograms[/[:format]]',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\Program',
                'action' => 'get-programs',
                'format' => 'json'
            ),
            'constraints' => array(
                'format' => '[a-zA-Z][a-zA-Z0-9_-]+',
            ),
        ),
        'may_terminate' => true,
    ),
    'getprogramsbydate' => array(
        'type' => 'segment',
        'options' => array(
            'route' => '/getprogramsbydate/:from/:to[/[:format]]',
            'defaults' => array(
                'controller' => 'Application\Controller\Api\Program',
                'action'     => 'get-programs-by-date',
                'format'     => 'json'
            ),
            'constraints' => array(
                'format'  => '[a-zA-Z][a-zA-Z0-9_-]+',
                'from'   => '\d{8}',
                'to'      => '\d{8}'
            ),
        ),
        'may_terminate' => true,
    ),
	'programs' => array(
		'type' => 'segment',
		'options' => array(
			'route' => '/programs',
			'constraints' => array(
				'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
				'programId' => '\d+',
			),
			'defaults' => array(
				'controller' => 'Application\Controller\Api\Program',
			),
		),
		'child_routes' => array(
			'get' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'get',
					'defaults' => array(
						'action' => 'index',
					),
				),
				'may_terminate' => true,
                'child_routes' => array(
                    'action' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:action[/:programId]',
                        ),
                        'may_terminate' => true,

                    ),
                    'memos' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:programId/memos/:memoType',
                            'constraints' => array(
                                'memoType' => '(program|subscription)',
                            ),
                            'defaults' => array(
                                'controller' => 'Application\Controller\Api\Memo',
                                'memoType' => 'subscription',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                ),
			),
			'post' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'post',
					'defaults' => array(
						'action' => 'update',
					),
				),
				'may_terminate' => true,
                'child_routes' => array(
                    'action' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:action[/:programId]',
                        ),
                        'may_terminate' => true,

                    ),
					'memos' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/:programId/memos/:memoType/:memoId',
							'constraints' => array(
								'memoType' => '(program|subscription)',
							),
							'defaults' => array(
								'controller' => 'Application\Controller\Api\Memo',
								'memoType' => 'subscription',
							),
						),
						'may_terminate' => true,
					),
					'authority-upload' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '/:programId/authorities/upload',
							'defaults' => array(
								'action' => 'authority-upload',
							),
						),
						'may_terminate' => true,
					),
                ),
			),
            'delete' => array(
                'type' => 'method',
                'options' => array(
                    'verb' => 'delete',
                    'defaults' => array(
                        'action' => 'delete',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'memos' => array(
                        'type' => 'segment',
                        'options' => array(
                            'route' => '/:programId/memos/:memoType/:memoId',
                            'constraints' => array(
                                'memoType' => '(program|subscription)',
                                'memoId' => '\d+'
                            ),
                            'defaults' => array(
                                'controller' => 'Application\Controller\Api\Memo',
                                'memoType' => 'subscription',
                            ),
                        ),
                        'may_terminate' => true,
                    ),
                ),
            ),
		),
	),
	'technologies' => array(
		'type' => 'segment',
		'options' => array(
			'route' => '/technologies[/:action][/:technologyId]',
			'constraints' => array(
				'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
				'technologyId' => '\d+',
			),
			'defaults' => array(
				'controller' => 'Application\Controller\Api\Technology',
			),
		),
		'child_routes' => array(
			'get' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'get',
					'defaults' => array(
						'action' => 'index',
					),
				),
				'may_terminate' => true,
			),
			'post' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'post',
					'defaults' => array(
						'action' => 'update',
					),
				),
				'may_terminate' => true,
			),
		),
	),
	'technologycategories' => array(
		'type' => 'segment',
		'options' => array(
			'route' => '/technology-categories[/[:action]][/[:technologyCategoryId]]',
			'constraints' => array(
                'action' => '[a-zA-Z][a-zA-Z0-9_-]+',
                'technologyId' => '\d+',
			),
			'defaults' => array(
				'controller' => 'Application\Controller\Api\TechnologyCategory',
			),
		),
		'child_routes' => array(
			'get' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'get',
					'defaults' => array(
						'action' => 'index',
					),
				),
				'may_terminate' => true,
			),
			'post' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'post',
					'defaults' => array(
						'action' => 'update',
					),
				),
				'may_terminate' => true,
			),
		),
	),
	'energy-categories' => array(
		'type' => 'segment',
		'options' => array(
			'route' => '/energy-categories',
			'defaults' => array(
				'controller' => 'Application\Controller\Api\EnergyCategory',
			),
		),
		'child_routes' => array(
			'get' => array(
				'type' => 'method',
				'options' => array(
					'verb' => 'get',
					'defaults' => array(
						'action' => 'index',
					),
				),
				'may_terminate' => true,
				'child_routes' => array(
					'with_id' => array(
						'type' => 'segment',
						'options' => array(
							'route' => '[/:energyCategoryId]',
							'constraints' => array(
								'energyCategoryId' => '\d+',
							),
						),
						'may_terminate' => true,
						'child_routes' => array(
							'tech-categories' => array(
								'type' => 'literal',
								'options' => array(
									'route' => '/technology-categories',
									'defaults' => array(
										'controller' => 'Application\Controller\Api\TechnologyCategory',
									),
								),
								'may_terminate' => true,
								'child_routes' => array(
									'with_id' => array(
										'type' => 'segment',
										'options' => array(
											'route' => '/:technologyCategoryId',
										),
										'may_terminate' => true,
										'child_routes' => array(
											'technologies' => array(
												'type' => 'literal',
												'options' => array(
													'route' => '/technologies',
													'defaults' => array(
														'controller' => 'Application\Controller\Api\Technology',
													),
												),
												'may_terminate' => true,
												'child_routes' => array(
													'with_id' => array(
														'type' => 'segment',
														'options' => array(
															'route' => '/:technologyId'

														),
														'may_terminate' => true,
													),
												),
											),
										),
									),
								),
							),
						),
					)
				),
			),
		),
	),

);