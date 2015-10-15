<?php
use FzyAuth\Util\Acl\Resource as AclResource;

return array(
    \FzyAuth\Service\Base::MODULE_CONFIG_KEY => array(
        'acl' => array(
	        'roles' => array(
		        \Application\Entity\Base\UserInterface::ROLE_GUEST => array(
					'allow' => array(
						array(
							AclResource::KEY_ROUTE => 'home',
						),
						array(
							AclResource::KEY_ROUTE => \ZfcUser\Controller\UserController::ROUTE_LOGIN,
						),
						array(
							AclResource::KEY_ROUTE => \ZfcUser\Controller\UserController::ROUTE_REGISTER,
						),
						array(
							AclResource::KEY_ROUTE => \ZfcUser\Controller\UserController::CONTROLLER_NAME . '/authenticate',
						),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Sitemap',
                            AclResource::KEY_ACTIONS => array('index', 'xml'),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Program',
                            AclResource::KEY_ACTIONS => array('index', 'tables', 'news', 'maps', 'detail'),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Password',
                            AclResource::KEY_ACTIONS => array('index','reset','forgot'),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Rss',
                            AclResource::KEY_ACTIONS => array(
                                'all',
                                'program',
                                'state'
                            ),
                        ),
						// api routes
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Program',
                            AclResource::KEY_ACTIONS => array('index', 'by-state', 'by-type', 'by-type-and-state', 'news', 'get-programs', 'get-programs-by-date'),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Technology',
                            AclResource::KEY_ACTIONS => array('index'),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\TechnologyCategory',
                            AclResource::KEY_ACTIONS => array('index'),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\EnergyCategory',
                            AclResource::KEY_ACTIONS => array('index'),
                        ),
						array(
							AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Export',
							AclResource::KEY_ACTIONS => array(
								'index',
							),
						),
                        array(
							AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Type',
							AclResource::KEY_ACTIONS => array(
								'index',
							),
						),
						array(
							AclResource::KEY_CONTROLLER => 'Application\Controller\Api\ImplementingSector',
							AclResource::KEY_ACTIONS => array(
								'index',
							),
						),
						array(
							AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Category',
							AclResource::KEY_ACTIONS => array(
								'index',
							),
						),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Utility',
                            AclResource::KEY_ACTIONS => array(
                                'index', 'hasprogram',
                            ),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\County',
                            AclResource::KEY_ACTIONS => array(
                                'index',
                            ),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\City',
                            AclResource::KEY_ACTIONS => array(
                                'index',
                            ),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\ZipCode',
                            AclResource::KEY_ACTIONS => array(
                                'index',
                            ),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Sector',
                            AclResource::KEY_ACTIONS => array(
                                'index',
                            ),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Memo',
                            AclResource::KEY_ACTIONS => array(
                                'index',
                            ),
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\State',
                            AclResource::KEY_ACTIONS => array(
                                'index', 'territories'
                            ),
                        ),
                        // allow users to view subscription memos
                        array(
                            AclResource::KEY_RESOURCE => \Application\Service\Search\Base\DQL\Memo::RESOURCE_NAME,
                            AclResource::KEY_PRIVILEGES => array(
                                \Application\Service\Search\Base\DQL\Memo\Subscription::PRIVILEGE,
                            ),
                        ),
					),
					'deny' => array(

					),
				),
				\Application\Entity\Base\UserInterface::ROLE_USER => array(
					'inherits' => array(\FzyAuth\Entity\Base\UserInterface::ROLE_GUEST),
					'allow' => array(
						// web routes
						array(
							AclResource::KEY_ROUTE => 'home',
						),
						array(
							AclResource::KEY_ROUTE => \ZfcUser\Controller\UserController::ROUTE_CHANGEEMAIL,
						),
						array(
							AclResource::KEY_ROUTE => \ZfcUser\Controller\UserController::ROUTE_CHANGEPASSWD,
						),
						array(
							AclResource::KEY_ROUTE => \ZfcUser\Controller\UserController::CONTROLLER_NAME,
						),
						array(
							AclResource::KEY_ROUTE => \ZfcUser\Controller\UserController::CONTROLLER_NAME . '/logout',
						),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Program',
                            AclResource::KEY_ACTIONS => array('new', 'edit',),
                        ),

                        // allow users to view program (internal) memos
                        array(
                            AclResource::KEY_RESOURCE => \Application\Service\Search\Base\DQL\Memo::RESOURCE_NAME,
                            AclResource::KEY_PRIVILEGES => array(
                                \Application\Service\Search\Base\DQL\Memo\Program::PRIVILEGE,
                            ),
                        ),
                        // list contacts
                        array(
                            AclResource::KEY_ROUTE => 'api/contacts/get',
                        ),
                        array(
                            AclResource::KEY_ROUTE => 'api/contacts/post',
                        ),
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Program',
                            AclResource::KEY_ACTIONS => array('all', 'update', 'create', 'authority-upload'),
                        ),

                    ),
					'deny' => array(
					),
				),
		        \Application\Entity\Base\UserInterface::ROLE_ADMIN => array(
			        'inherits' => array(\FzyAuth\Entity\Base\UserInterface::ROLE_USER),
			        'allow' => array(
				        // WEB routes
				        array(
					        AclResource::KEY_ROUTE => 'home/system/contact',
				        ),
				        array(
					        AclResource::KEY_ROUTE => 'home/system/user',
				        ),

				        // API routes
                        // reset other users' passwords
                        array(
                            AclResource::KEY_CONTROLLER => 'Application\Controller\Api\User',
                            AclResource::KEY_ACTIONS => array('reset-password'),
                        ),
						// list users
				        array(
					        AclResource::KEY_ROUTE => 'api/users/get',
				        ),
				        // update/create users
				        array(
					        AclResource::KEY_ROUTE => 'api/users/post',
				        ),
						// list roles
				        array(
					        AclResource::KEY_ROUTE => 'api/roles',
				        ),
				        array(
					        AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Type',
					        AclResource::KEY_ACTIONS => array(
						        'all',
					        ),
				        ),
				        array(
					        AclResource::KEY_CONTROLLER => 'Application\Controller\Api\ImplementingSector',
					        AclResource::KEY_ACTIONS => array(
						        'all',
					        ),
				        ),
				        array(
					        AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Category',
					        AclResource::KEY_ACTIONS => array(
						        'all',
					        ),
				        ),
						array(
							AclResource::KEY_CONTROLLER => 'Application\Controller\Api\Memo',
							AclResource::KEY_ACTIONS => array(
								'update', 'delete'
							),
						),

						// allow admins to edit memos
						array(
							AclResource::KEY_RESOURCE => \Application\Service\Update\Memo::RESOURCE_NAME,
							AclResource::KEY_PRIVILEGES => array(
								\Application\Service\Update\Memo::PRIVILEGE_PROGRAM,
								\Application\Service\Update\Memo::PRIVILEGE_SUBSCRIPTION,
							),
						),

			        ),
			        'deny' => array(

                    ),
		        ),
	        ),
        ),
    ),
);