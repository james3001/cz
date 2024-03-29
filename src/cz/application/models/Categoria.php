<?php

class Application_Model_Categoria extends Zend_Db_Table {
    
    protected $_name = 'categoria';
    
    public function getCategorias(){
        $db = $this->getAdapter();
        //$db = Zend_Db_Table::getDefaultAdapter();
        
        $where = $db->quoteInto('activo = ?', 1);
        
        return $this->fetchAll(/*$where*/);
        
    }

    public function getPaginator() {
        $paginator = Zend_Paginator::factory($this->getCategorias());
        $paginator->setItemCountPerPage(2);
        return $paginator;
    }


    public function getCategoriasCbo(){
        $db = $this->getAdapter();
        return $db->fetchPairs($this->select()->where('activo = ?', 1));
        
    }
}
