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
    
    
    public function indexAction(){
        $form = new Application_Form_Producto();
        
        if ($this->_request->isPost()){
            $params = $this->_getAllParams();
            $isValid = $form->isValid($params);
            
            if($isValid){
                
                //
                
            }
            
            
        }
        
        
        $this->view->form = $form;
        
    }
    
}

?>
