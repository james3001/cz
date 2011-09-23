<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Action
 *
 * @author Administradores1
 */
class App_Controller_Action extends Zend_Controller_Action {
    
    public $log = null;
    public $session = null;
    
    public function init() {
        parent::init();
        
        $this->log = $this->getLog();
        $this->session = $this->getSession();
        
    }
    
    public function getSession(){
        $session = new Zend_Session_Namespace('Ventas');
        return $session;
    }

    public function getLog() {
        // config del logger
        $logger = new Zend_Log();
        $writer1 = new Zend_Log_Writer_Stream(APPLICATION_PATH . "/../logs/application.log");
        $writer2 = new Zend_Log_Writer_Firebug();
        $filter = new Zend_Log_Filter_Priority(Zend_Log::ERR);
        $logger->addWriter($writer1);
        $logger->addWriter($writer2);

//        
//        $logger->log("emerg",  zend_log::EMERG);
//        $logger->log("alert",  zend_log::ALERT);
//        $logger->log("crit",  zend_log::CRIT);
//        $logger->log("err",  zend_log::ERR);
//        $logger->log("warn",  zend_log::WARN);
//        $logger->log("not",  zend_log::NOTICE);
//        $logger->log("info",  zend_log::INFO);
//        $logger->log("debug",  zend_log::DEBUG);

        return $logger;
        
    }

}

?>
