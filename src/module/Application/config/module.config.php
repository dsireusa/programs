<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
namespace Application;

use FzyAuth\Service\Password\Forgot;

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
	            'child_routes' => require 'routes.web.config.php',
            ),
	        'api' => array(
		        'type' => 'Literal',
		        'options' => array(
			        'route' => '/api/v1',
			        'defaults' => array(
				        'controller' => 'Application\Controller\Api\Index',
			            'action' => 'index',
			        ),
		        ),
		        'may_terminate' => true,
		        'child_routes' => require 'routes.api.config.php',
	        ),
            'sitemap' => array(
                'type' => 'literal',
                'options' => array(
                    'route' => '/sitemap',
                    'defaults' => array(
                        'controller' => 'Application\Controller\Sitemap',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'xml' => array(
                        'type' => 'literal',
                        'options' => array(
                            'route' => '/xml',
                            'defaults' => array(
                                'action' => 'xml',
                            ),
                        ),
                    ),
                ),
            ),

        ),
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'aliases' => array(
            'translator' => 'MvcTranslator',
        ),
        'factories' => array(
	        'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'FzyCommon\Service\Aws\Config' => function($sm) {
                return $sm->get('FzyCommon\Config')->getWrapped('aws_services');
            },
            'Application\WpConfig' => function($sm) {
                return $sm->get('FzyCommon\Config')->getWrapped('wordpress');
            },
        ),
	    'invokables' => array(
		    'Application\Service\Cli\Migrate' => 'Application\Service\Cli\Migrate\Base',
            'Application\Service\Cli\Export' => 'Application\Service\Cli\Export\Base',

		    'users' => 'Application\Service\Search\Base\DQL\User',
		    'user' => 'Application\Service\Update\User',
            // admin service to send a password reset email to a user
            'user_password_reset' => 'Application\Service\Update\User\Password',

		    'contacts' => 'Application\Service\Search\Base\DQL\Contact',
		    'contact' => 'Application\Service\Update\Contact',

		    'programs' => 'Application\Service\Search\Base\DQL\Program',
		    'program' => 'Application\Service\Update\Program\Edit',
            'programs_published' => 'Application\Service\Search\Base\DQL\Program\Published',
            'program_published_ids' => 'Application\Service\Search\Base\DQL\Program\Published\Ids',
		    'program_create' => 'Application\Service\Update\Program\Create',
            'programs_by_state' => 'Application\Service\Search\Base\DQL\Program\Published\ByState',
            'programs_by_type' => 'Application\Service\Search\Base\DQL\Program\Published\ByType',
            'get_programs' => 'Application\Service\Search\Base\DQL\Program\Published\GetPrograms',
            'get_programs_by_date' => 'Application\Service\Search\Base\DQL\Program\GetProgramsByDate',

            'program_contact' => 'Application\Service\Update\ProgramContact',
            'program_contacts' => 'Application\Service\Search\Base\DQL\ProgramContact',

            'memo' => 'Application\Service\Update\Memo',
            'memos_program' => 'Application\Service\Search\Base\DQL\Memo\Program',
            'memos_subscription' => 'Application\Service\Search\Base\DQL\Memo\Subscription',
            'memos_subscription_rss' => 'Application\Service\Search\Base\DQL\Memo\Subscription\ForRss',

		    'states' => 'Application\Service\Search\Base\DQL\State',
            'territories' => 'Application\Service\Search\Base\DQL\State\Territory',

		    'implementing_sectors' => 'Application\Service\Search\Base\DQL\ImplementingSector',
		    'categories' => 'Application\Service\Search\Base\DQL\Category',

		    'types' => 'Application\Service\Search\Base\DQL\Type',
		    'types_published' => 'Application\Service\Search\Base\DQL\Type\Published',

		    'implementing_sectors' => 'Application\Service\Search\Base\DQL\ImplementingSector',
		    'implementing_sectors_published' => 'Application\Service\Search\Base\DQL\ImplementingSector\Published',

		    'categories' => 'Application\Service\Search\Base\DQL\Category',
		    'categories_published' => 'Application\Service\Search\Base\DQL\Category\Published',


		    'roles' => 'Application\Service\Search\Base\Role',

            'technology_categories' => 'Application\Service\Search\Base\DQL\TechnologyCategory',

            'energy_categories' => 'Application\Service\Search\Base\DQL\EnergyCategory',

            'technologies' => 'Application\Service\Search\Base\DQL\Technology',
            'technology_ids' => 'Application\Service\Search\Base\DQL\Technology\Ids',

            'utilities' => 'Application\Service\Search\Base\DQL\Utility',
            'utilities-has-program' => 'Application\Service\Search\Base\DQL\Utility\HasProgram',

            'county' => 'Application\Service\Update\County',
            'counties' => 'Application\Service\Search\Base\DQL\County',

            'city' => 'Application\Service\Update\City',
            'cities' => 'Application\Service\Search\Base\DQL\City',


            'zip-codes' => 'Application\Service\Search\Base\DQL\ZipCode',

            'sectors' => 'Application\Service\Search\Base\DQL\Sector',
            'sectors_map' => 'Application\Service\Search\Base\DQL\Sector\Map',

            'detail' => 'Application\Service\Update\Detail',
            'details' => 'Application\Service\Search\Base\DQL\Detail',

            'details_templates' => 'Application\Service\Search\Base\DQL\DetailTemplate',

            'authority' => 'Application\Service\Update\Authority',
            'authorities' => 'Application\Service\Search\Base\DQL\Authority',

            'authority_upload' => 'Application\Service\Update\Authority\Upload',

            'parameter_sets' => 'Application\Service\Search\Base\DQL\ParameterSet',
            'parameter_set' => 'Application\Service\Update\ParameterSet',

            'exports' => 'Application\Service\Search\Base\DQL\Export',
	    ),
    ),
    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
	        // web controllers
            'Application\Controller\Sitemap' => 'Application\Controller\SitemapController',
            'Application\Controller\Index' => 'Application\Controller\IndexController',
			'Application\Controller\User' => 'Application\Controller\UserController',
			'Application\Controller\Contact' => 'Application\Controller\ContactController',
			'Application\Controller\Program' => 'Application\Controller\ProgramController',
            'Application\Controller\Rss' => 'Application\Controller\RssController',
            'FzyAuth\Controller\Password' => 'Application\Controller\PasswordController',
	        // api routes
            'Application\Controller\Api\Index' => 'Application\Controller\Api\IndexController',
            'Application\Controller\Api\User' => 'Application\Controller\Api\UserController',
	        'Application\Controller\Api\Contact' => 'Application\Controller\Api\ContactController',
	        'Application\Controller\Api\Role' => 'Application\Controller\Api\RoleController',
	        'Application\Controller\Api\State' => 'Application\Controller\Api\StateController',
	        'Application\Controller\Api\Program' => 'Application\Controller\Api\ProgramController',
            'Application\Controller\Api\Technology' => 'Application\Controller\Api\TechnologyController',
            'Application\Controller\Api\TechnologyCategory' => 'Application\Controller\Api\TechnologyCategoryController',
            'Application\Controller\Api\EnergyCategory' => 'Application\Controller\Api\EnergyCategoryController',
	        'Application\Controller\Api\Type' => 'Application\Controller\Api\TypeController',
	        'Application\Controller\Api\ImplementingSector' => 'Application\Controller\Api\ImplementingSectorController',
	        'Application\Controller\Api\Category' => 'Application\Controller\Api\CategoryController',
	        'Application\Controller\Api\ImplementingSector' => 'Application\Controller\Api\ImplementingSectorController',
            'Application\Controller\Api\Utility' => 'Application\Controller\Api\UtilityController',
            'Application\Controller\Api\County' => 'Application\Controller\Api\CountyController',
            'Application\Controller\Api\City' => 'Application\Controller\Api\CityController',
            'Application\Controller\Api\ZipCode' => 'Application\Controller\Api\ZipCodeController',
            'Application\Controller\Api\Sector' => 'Application\Controller\Api\SectorController',
            'Application\Controller\Api\Memo' => 'Application\Controller\Api\MemoController',
            'Application\Controller\Api\Export' => 'Application\Controller\Api\ExportController',

	        // console controllers
	        'Application\Controller\CLI' => 'Application\Controller\CommandLineController',
        ),
    ),
    'view_helpers' => array(
	    'factories' => array(
		    'mainMenu' => function($sm) {
			    /* @var $locator \Zend\ServiceManager\ServiceManager */
			    $locator = $sm->getServiceLocator();
			    $nav = $sm->get('Zend\View\Helper\Navigation')->menu('navigation');
			    $nav->setUlClass('');
			    $nav->escapeLabels(false);
			    $nav->setMaxDepth(1);
			    //$nav->setPartial('partials/primary-nav');
			    $acl = $locator->get('FzyAuth\Acl');
			    $role = $locator->get('FzyAuth\CurrentUser')->getRole();
                $nav->setAcl($acl);
                $nav->setRole($role);
			    return $nav->setUlClass('nav')->setTranslatorTextDomain(__NAMESPACE__);
		    },
	    ),
        'invokables' => array(
            'wpUrl' => 'Application\View\Helper\WpUrl',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'controller_map' => array(
            'Application\Controller\PasswordController' => 'fzy-auth/password',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        'strategies' => array(
	        'ViewJsonStrategy',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
				'migrate' => array(
					'options' => array(
						'route'    => 'migrate [<table>]',
						'defaults' => array(
							'controller' => 'Application\Controller\CLI',
							'action' => 'migrate'
						),
					),
				),
                'export' => array(
                    'options' => array(
                        'route' => 'export [<type>]',
                        'defaults' => array(
                            'controller' => 'Application\Controller\CLI',
                            'action' => 'export',
                        ),
                        'constraints' => array(
                            'type' => '(xml|csv)'
                        ),
                    ),
                ),
            ),
        ),
    ),

    'zfcuser' => array(
	    // telling ZfcUser to use our own class
	    'user_entity_class'       => 'Application\Entity\Base\User',
	    'enable_username' => false,
        'enable_user_state' => true,
        'default_user_state' => 'active',
        'allowed_login_states' => array('active')
    ),

	\FzyAuth\Service\Base::MODULE_CONFIG_KEY => array(
		'null_user_class' => 'Application\Entity\Base\UserNull',

        Forgot::OPTIONS => array(
            'from_email' => 'no-reply@dsireusa.org',
            'from_name' => 'DSIRE',
            'reset_subject' => 'DSIRE - Please Reset Your Password',
        ),
	),

    // Password management options
    'password_management' => array(
        'password_cost'    => 14,
        'from_email'       => 'no-reply@dsireusa.org',
        'from_name'        => 'DSIRE',
        // This is your admin account
        'copy_to'          => array(),
        'reset_subject'    => 'DSIRE - Please Reset Your Password',
        'new_user_subject' => 'DSIRE - Please Create Your Password',
    ),

	'doctrine' => array(
		'driver' => array(
			__NAMESPACE__ . '_driver' => array(
				'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
				'cache' => 'array',
				'paths' => array(__DIR__ . '/../src/' . __NAMESPACE__ . '/Entity')
			),
			'orm_default' => array(
				'drivers' => array(
					__NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
				)
			)
		)
	),

);
