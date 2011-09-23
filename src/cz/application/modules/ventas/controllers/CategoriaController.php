<?php

class Ventas_CategoriaController extends App_Controller_Action {

    protected $_categoria;

    public function init() {
        $this->_categoria = new Application_Model_Categoria();
        $fm = $this->_helper->flashMessenger;
        $this->view->mensajes = $fm->getMessages();
    }

    public function indexAction() {
        $log = new Zend_Log();
        
        
        
        
        
        //$log = Zend_Registry::get('log');
        //$this->view->categorias = $this->_categoria->getCategorias();
        $paginator = $this->_categoria->getPaginator();
        $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        $this->view->categorias = $paginator;
        $sess = new Zend_Session_Namespace('ventas');
        $this->view->catErrada = $sess->catErrada;
    }
    
    

    // ajax endpoint
    public function validaCategoriaAction() {
        $this->_helper->layout->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $val = new Zend_Validate_Db_NoRecordExists(
            array(
                'table' => 'categoria',
                'field' => 'nombre'
            )
        );


        $valor = $this->_getParam('nombre', '');

        $isValid = false;
        if ($valor != '') {
            $isValid = $val->isValid($valor);
        }else{
            throw new Zend_Validate_Exception('debes setear el nombre');
        }

        if ($isValid) {
            $response = array(
                'status' => 'OK',
                'msg' => 'Nombre de categoría: disponible'
            );
        } else {
            $response = array(
                'status' => 'ERROR',
                'msg' => 'Nombre de categoría: NO disponible'
            );
        }

        $json = Zend_Json::encode($response);

        $this->_response->appendBody($json);
    }

    public function nuevoAction() {
        $form = new Application_Form_Categoria();

        if ($this->_request->isPost()) {
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);
            if ($isValid) {
                $this->_categoria->insert($form->getValues());
                $this->_helper->flashMessenger('Se insertó correctamente');
                $this->_redirect('/ventas/categoria');
            } else {
                $sess = new Zend_Session_Namespace('ventas');
                $sess->catErrada = $this->_getParam('nombre');
                $sess->setExpirationSeconds(30, 'catErrada');
                $sess->setExpirationHops(4, 'catErrada');
            }
        }
        $this->view->form = $form;
    }

    public function editarAction() {
        $id = $this->_getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Form_Categoria();
        $where = $db->quoteInto('id = ?', $id);
        $row = $this->_categoria->fetchRow($where)->toArray();
        $form->setDefaults($row);

        if ($this->_request->isPost()) {
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);
            if ($isValid) {
                $this->_categoria->update($form->getValues(), $where);
                $this->_helper->flashMessenger('Se editó correctamente');
                $this->_redirect('/ventas/categoria');
            }
        }
        $this->view->form = $form;
    }

    public function activarAction() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $where = $db->quoteInto('id = ?', $this->_getParam('id'));
        $this->_categoria->update(array('activo' => '1'), $where);
        $this->_helper->flashMessenger('Categoria Activada');
        $this->_redirect('/ventas/categoria');
    }

    public function desactivarAction() {
        $db = Zend_Db_Table::getDefaultAdapter();
        $where = $db->quoteInto('id = ?', $this->_getParam('id'));
        $this->_categoria->update(array('activo' => '0'), $where);
        $this->_helper->flashMessenger('Categoria Activada');
        $this->_redirect('/ventas/categoria');
    }
    
//    public function ejemploWSAction(){
//        $server = new Zend_Json_Server();
//        $server->setClass('App_Mi_Clase_Ws');
//        
//        /*
//         * 
//         */
//    }

}

