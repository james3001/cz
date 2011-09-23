<?php

class Application_Model_Producto extends Zend_Db_Table {
    
    protected $_name = 'producto';

    public function listar() {
        $db = $this->getAdapter();
        $filas = $db->select()
            ->from($this->_name)
            ->join(
                'categoria',
                'producto.id_categoria=categoria.id',
                array('categoria'=>'nombre')
            )
            ->join(
                'fabricante',
                'producto.id_fabricante=fabricante.id',
                array('fabricante'=>'nombre')
            )
            ->query();
        return $filas;
    }
    
    public function getAllProductos() {
        return $this->getAdapter()->select()->from($this->_name);
        //return $this->fetchAll();
    }
    
    public function getPaginator(){
        $paginador = Zend_Paginator::factory($this->listar()->fetchAll());
        $paginador->setItemCountPerPage(10);
        //$pag->setRowCount(500);
        return $paginador;
    }

    /*public function getProductosYCategorias(){
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
    }*/
    
    public function getDetalle($producto_id){
        $db = $this->getAdapter();
        $query = $db->select()
            ->from(
                $this->_name,
                array(
                    'id_producto'=>'id',
                    'producto'=>'nombre',
                    'precio'
                )
            )
            ->joinLeft(
                'categoria',
                'producto.id_categoria=categoria.id',
                array(
                    'categoria' => 'nombre'
                )
            )
            ->joinLeft(
                'fabricante',
                'producto.id_fabricante=fabricante.id',
                array(
                    'fabricante' => 'nombre'
                )
            )
            ->where('producto.id = ? ',$producto_id)
        ;

        return $db->fetchRow($query);

    }
    
    
}
