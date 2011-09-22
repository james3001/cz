<?php

class Temas_HomeController extends Zend_Controller_Action
{

    public function init()
    {
        $this->_helper->layout->setLayout('temas');
    }

    public function indexAction(){

    }





    
    public function flashMessengerAction()
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
        $writer1 = new Zend_Log_Writer_Stream(APPLICATION_PATH."/../logs/application.log");
        $writer2 = new Zend_Log_Writer_Firebug();
        $filter = new Zend_Log_Filter_Priority(Zend_Log::ERR);
        $logger->addWriter($writer1);
        $logger->addWriter($writer2);
        //$logger->addFilter($filter);
        
        $data = array(1,2,3,array(7,8,9),"asdsa",5);
        
        $logger->debug($data);
        $logger->debug($writer2);
        
//        
//        $logger->log("emerg",  zend_log::EMERG);
//        $logger->log("alert",  zend_log::ALERT);
//        $logger->log("crit",  zend_log::CRIT);
//        $logger->log("err",  zend_log::ERR);
//        $logger->log("warn",  zend_log::WARN);
//        $logger->log("not",  zend_log::NOTICE);
//        $logger->log("info",  zend_log::INFO);
//        $logger->log("debug",  zend_log::DEBUG);
//        
        
        
        
        
        // uso
//        $logger->log("Entraron a Contacto (Firebug) ", Zend_Log::CRIT );
//        $logger->debug("Entraron a Contacto DBG");
        
        
        $this->_helper->flashMessenger('Probando el flash messenger<br />');
        //$this->_redirect('/');
        
    }


}

