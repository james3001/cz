<?php

class Application_Form_Producto extends Zend_Form 
{

    public function init() {
        
        $_categoria = new Application_Model_Categoria();
        $catValues = $_categoria->getCategoriasCbo();
        $_fabricante = new Application_Model_Fabricante();
        $fabValues = $_fabricante->getFabricanteCbo();
        
        
        parent::init();
        
        $e = new Zend_Form_Element_Select('id_categoria');
        $e->setLabel('Categoría');
        $e->addMultiOption('-1','-- Seleccione Categoría --');
        $e->addMultiOptions($catValues);
        $opc = array_keys($catValues);
        $v = new Zend_Validate_InArray($opc);
        $e->addValidator($v);        
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('id_fabricante');
        $e->setLabel('Fabricante');
        $e->addMultiOption('-1','-- Seleccione Fabricante --');
        $e->addMultiOptions($fabValues);
        $opc = array_keys($fabValues);
        $v = new Zend_Validate_InArray($opc);
        $e->addValidator($v);        
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('nombre');
        $e->setRequired(true);
        $v = new Zend_Validate_StringLength(array('min' => 3, 'max' => 14));
        $e->addValidator($v);
        $e->setLabel('Nombre');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Textarea('descripcion');
        $e->setLabel('Descripción');
        $e->setAttrib('cols', 40);
        $e->setAttrib('rows', 3);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Text('precio');
        $e->setLabel('Precio');
        $e->addValidator(new Zend_Validate_Float(new Zend_Locale('es_PE')));
        $this->addElement($e);
        
        
        
        
        $e = new Zend_Form_Element_Submit('submit');
        $e->setLabel('Enviar');
        $this->addElement($e);
        
        
    }
    
}

?>
