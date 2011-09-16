<?php

class Application_Model_Fabricante extends Zend_Db_Table {
    
    protected $_name = 'fabricante';
    
    public function getFabricanteCbo(){
        $db = $this->getAdapter();
        return $db->fetchPairs($this->select()->where('activo = ?', 1));
        
    }
}
