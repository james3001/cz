<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $fm = $this->_helper->flashMessenger;
        $this->view->mensajes = $fm->getMessages();
    }

    public function configAction()
    {
        
        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/cz.ini');
        $arr = $config->toArray();
        var_dump($arr['redessociales']['facebook']['token']);
        var_dump($config->redessociales->facebook->token);
        echo "<hr>";
        $configPag = new Zend_Config_Ini(APPLICATION_PATH.'/configs/cz.ini','paginadores');
        var_dump($configPag->toArray());
    }

    public function contactoAction()
    {
        // config del logger
        $logger = new Zend_Log();
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH."/../logs/application.log");
        $filter = new Zend_Log_Filter_Priority(Zend_log::ERR);
        $logger->addFilter($filter);
        $logger->addWriter($writer);
        
        // uso
        $logger->log("Entraron a Contacto", Zend_Log::CRIT );
        $logger->debug("Entraron a Contacto DBG");
        
        
        $this->_helper->flashMessenger('Probando el flash messenger<br />');
        //$this->_redirect('/');
        
    }


}

