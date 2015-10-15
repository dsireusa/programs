<?php
return array(
    'doctrine' => array(
        'connection' => array(
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host' => 'localhost',
                    'port' => '3306',
                    'dbname' => 'CHANGEME',
                ),
            ),
        ),
        'configuration' => array(
	        'orm_default' => array(
		        'generate_proxies' => false,
	        ),
        ),
    ),
    \FzyCommon\Service\Base::MODULE_CONFIG_KEY => array(
        'doctrine_cache_config' => array(
            'host' => 'cache01.l832z9.0001.use1.cache.amazonaws.com',
            'port' => 6379,
        ),
    ),
);
