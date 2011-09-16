<?php

class Ventas_CategoriaController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $_categoria = new Application_Model_Categoria();
        $db = $_categoria->getAdapter();
        
        $where = $db->quoteInto('activo = ?', 1);
        
        $this->view->categorias = $_categoria->fetchAll($where);
        
    }

}

