<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'doctrine' => array(
    	'driver' => array(
    		'application_entities' => array(
    			'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
    		    'cache' => 'array',
    		    'paths' => array(
    		    	__DIR__ . '/../../module/Application/src/Application/Entity',
    		    ),
    		),
    		'orm_default' => array(
    				'drivers' => array(
    						'Application\Entity' => 'application_entities',
    				),
    		),
    	),
        
    ),
);
