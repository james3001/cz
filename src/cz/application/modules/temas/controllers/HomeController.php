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

        
        
        $this->_helper->flashMessenger('Probando el flash messenger<br />');
        //$this->_redirect('/');
        
    }


}

