<?php

class Application_Model_Producto extends Zend_Db_Table {
    
    protected $_name = 'producto';
    
    public function getProductosYCategorias(){
        $db = $this->getAdapter();
        $db = Zend_Db_Table::getDefaultAdapter();
        $sql = $db->select()
           ->from(
               $this->_name,array('id', 'producto'=>'nombre','precio')
           )->join(
                   'categoria',
                   'producto.id_categoria = categoria.id',
                   array('categoria'=>'nombre')
           )->joinLeft(
                   'fabricante',
                   'producto.id_fabricante = fabricante.id',
                   array('fabricante'=>'nombre')
           )->where($db->quoteInto('producto.activo = 1 AND producto.precio > ?', 1000));
                
            //->limit(1)
                ;
                
            //echo $sql->assemble();    
        return $db->fetchAll($sql);
        //return $db->fetchAll($sql);
        //return $db->fetchAll($sql);
//        return $db->fetchAssoc($sql);
//        return $db->fetchCol($sql);
//        return $db->fetchOne($sql);
//        return $db->fetchPairs($sql);
    }
}
