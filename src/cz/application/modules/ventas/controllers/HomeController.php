<?php

class Ventas_HomeController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
    }

    public function serviceAction()
    {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();
        $server = new Zend_Json_Server();

        $server->setClass('App_Server_Ventas');
        if ('GET' == $_SERVER['REQUEST_METHOD']) {
            $server->setEnvelope(Zend_Json_Server_Smd::ENV_JSONRPC_2);
            $smd = $server->getServiceMap();
            //header('Content-Type: application/json');
            echo $smd;
            return;
        }

        $server->handle();
    }
    public function clientAction() {
        $this->_helper->viewRenderer->setNoRender();

        $params = array(
            'jsonrpc' => '2.0',
            'method' => $this->_getParam('method'),
            'params' => array('x' => $this->_getParam('x'), 'y' => $this->_getParam('y')),
            'id' => 'test'
        );

        $http = new Zend_Http_Client();
        $http->setUri('http://cz/ventas/home/service');
        $http->setMethod(Zend_Http_Client::POST);
        $http->setRawData(Zend_Json::encode($params));

        $response = $http->request()->getBody();

        $respuesta = Zend_Json::decode($response);

        $this->_response->appendBody("<pre>" . print_r($respuesta, true) . "</pre>");
    }
}

