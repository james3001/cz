<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ApiController
 *
 * @author Administradores1
 */
class Ventas_ApiController extends App_Controller_Action {
    public function init() {
        parent::init();
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
    }

    
    /**
     * Funcoisakm alskjdlkas lsak
     * @param Zend_Json_Server $s sdkjsdlk
     * @param App_Controller_Action $c sdfds
     * @return App_Server_Ventas 
     * @author eanaya
     * @deprecated
     * @todo Validar lsdkndsl
     */
    public function hola(Zend_Json_Server $s, App_Controller_Action $c){
        $obj = new App_Server_Ventas();
        return $obj;
    }
    
    public function serverAction(){
        $server = new Zend_Json_Server();
        $obj = new App_Server_Ventas();
        $server->setClass($obj);
        if($_SERVER['REQUEST_METHOD']=='GET'){
            $server->envelope(
                Zend_Json_Server_Smd::ENV_JSONRPC_2
            );
            echo $server->getServiceMap();
            return;
        }
        $server->handle();
    }
    
    public function clientAction(){
        
        $srvParams = array(
            'jsonrpcs' => Zend_Json_Server::VERSION_2,
            'method' => 'repite',
            'params' => array(
                'texto' => $this->_getParam('nombre'),
                'veces' => $this->_getParam('edad')
            ),
            'id' => 'cliente_325432'
        );
        
        $http = new Zend_Http_Client();
        $http->setUri('http://cz/api/server');
        $http->setMethod(Zend_Http_Client::POST);
        $http->setRawData( Zend_Json::encode($srvParams) );
        $response = $http->request();
        $data = $response->getBody();
        $plain_data = Zend_Json::decode($data);
        var_dump($plain_data);
        
        
    }
    
}

?>
