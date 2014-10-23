<?php
/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
$zendApplication = Zend\Mvc\Application::init(require 'config/application.config.php');
Application\ZrayLauncher::go();
$zendApplication->run();
