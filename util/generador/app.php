<?php
    //date_default_timezone_set('Europe/London');

    define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../../src/cz/application'));
    defined('APPLICATION_ENV') ||
    define(
        'APPLICATION_ENV',
        (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : $env)
    );
 
    set_include_path(
        implode(
            PATH_SEPARATOR,
            array(
                realpath(APPLICATION_PATH . '/../library'),
                get_include_path()
            )
        )
    );
    require_once 'Zend/Loader/Autoloader.php';
    $autoloader = Zend_Loader_Autoloader::getInstance();

    require_once 'Zend/Application.php';

    // Create application, bootstrap, and run
    $application = new Zend_Application(
        APPLICATION_ENV,
        APPLICATION_PATH . '/configs/application.ini'
    );
    $application->bootstrap();