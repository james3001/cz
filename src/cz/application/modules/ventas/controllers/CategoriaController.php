<?php

class Ventas_CategoriaController extends Zend_Controller_Action
{
    protected $_categoria;

    public function init()
    {
        $this->_categoria = new Application_Model_Categoria();
        $fm = $this->_helper->flashMessenger;
        $this->view->mensajes = $fm->getMessages();
    }

    public function indexAction()
    {
        //$this->view->categorias = $this->_categoria->getCategorias();
        $paginator = $this->_categoria->getPaginator();
        $paginator->setCurrentPageNumber($this->_getParam('page',1));
        $this->view->categorias = $paginator;
        
    }

    public function nuevoAction()
    {
        $form = new Application_Form_Categoria();
        
        if($this->_request->isPost()){
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);
            if($isValid){
                
                $this->_categoria->insert($form->getValues());
                $this->_helper->flashMessenger('Se insertó correctamente');
                $this->_redirect('/ventas/categoria');
            }
        }
        $this->view->form = $form;
        
    }

    public function editarAction()
    {
        $id = $this->_getParam('id');
        $db = Zend_Db_Table::getDefaultAdapter();
        $form = new Application_Form_Categoria();
        $where = $db->quoteInto('id = ?', $id );
        $row = $this->_categoria->fetchRow($where)->toArray();
        $form->setDefaults($row);
        
        if($this->_request->isPost()){
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);
            if($isValid){
                $this->_categoria->update($form->getValues(),$where);
                $this->_helper->flashMessenger('Se editó correctamente');
                $this->_redirect('/ventas/categoria');
            }
        }
        $this->view->form = $form;
    }
    
    
    public function activarAction()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $where = $db->quoteInto('id = ?', $this->_getParam('id') );
        $this->_categoria->update(array('activo'=>'1'),$where);
        $this->_helper->flashMessenger('Categoria Activada');
        $this->_redirect('/ventas/categoria');
    }
    
    public function desactivarAction()
    {
        $db = Zend_Db_Table::getDefaultAdapter();
        $where = $db->quoteInto('id = ?', $this->_getParam('id') );
        $this->_categoria->update(array('activo'=>'0'),$where);
        $this->_helper->flashMessenger('Categoria Activada');
        $this->_redirect('/ventas/categoria');
    }

}

