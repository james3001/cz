<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    
    public function _initView() {
        
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->headTitle('CZ');
        $view->headTitle('Home');
        $view->headTitle()->setSeparator(' | ');
        
        
    }


}

