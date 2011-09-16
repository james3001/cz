<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Producto
 *
 * @author Administradores1
 */
class Ventas_ProductoController extends Zend_Controller_Action {
    
    protected $_producto;


    public function init() {
        parent::init();
        $this->_producto = new Application_Model_Producto();
        
    }


    public function indexAction(){
        
        
        $form = new Application_Form_Producto();
        
        if ($this->_request->isPost()){
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);
            
            if($isValid){
                
                //
            }
        }
        $this->view->productos = $this->_producto->getProductosYCategorias();
        
        $this->view->form = $form;
        
    }
    
    public function nuevoAction() {
        $form = new Application_Form_Producto();
        
        if($this->_request->isPost()){
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);

            if($isValid){
                $this->_producto->insert($form->getValues());
                $this->_helper->flashMessenger('Se insertó correctamente');
                $this->_redirect('/ventas/producto');
            }
            
        }
        $this->view->form = $form;
    }
    
}

?>
