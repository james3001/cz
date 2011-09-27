<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    public function _initAutoloader()
    {
        require_once 'Doctrine/Common/ClassLoader.php';

        $autoloader = \Zend_Loader_Autoloader::getInstance();

        $bisnaAutoloader = new \Doctrine\Common\ClassLoader('Bisna');
        $autoloader->pushAutoloader(array($bisnaAutoloader, 'loadClass'), 'Bisna');

        $appAutoloader = new \Doctrine\Common\ClassLoader('Models');
        $autoloader->pushAutoloader(array($appAutoloader, 'loadClass'), 'Models');

//        $appAutoloader = new \Doctrine\Common\ClassLoader('application', dirname(APPLICATION_PATH));
//        $autoloader->pushAutoloader(array($appAutoloader, 'loadClass'), 'application');
    }


//    protected function _initAuth()
//    {
//        $this->bootstrap('session');
//        $auth = Zend_Auth::getInstance();
//        if ($auth->hasIdentity()) {
//            $view = $this->getResource('view');
//            $view->user = $auth->getIdentity();
//        }
//        return $auth;
//    }

}

