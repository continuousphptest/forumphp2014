<?php
return array(
    'db' => array(
        'driver' => 'Pdo_Mysql',
        'database' => 'buggy_woogie',
        'username' => 'root',
        'password' => 'zend',
        'host' => 'localhost',
    ),
    'doctrine' => array(
    	'connection' => array(
    		'orm_default' => array(
    			'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
    		    'params' => array(
    		    	'host' => 'localhost',
    		        'user' => 'root',
    		        'password' => 'zend',
    		        'dbname' => 'buggy_woogie',
    		    ),
    		),
    	),
    ),
    'service_manager' => array(
    	'factories' => array(
    		'dbAdapter' => 'Zend\Db\Adapter\AdapterServiceFactory',
    	),
    ),
);
