<?php

class Application_Form_Producto extends Zend_Form 
{

    public function init() {
        
        $cats = array(
            'Abarrotes',
            'Higiene',
            'Electro',
            'Juguetes'
        );
        
        parent::init();
        
        $e = new Zend_Form_Element_Text('nombre');
        $e->setRequired(true);
        $v = new Zend_Validate_StringLength(array('min' => 3, 'max' => 14));
        $e->addValidator($v);
        $e->setLabel('Nombre');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Textarea('descripcion');
        $e->setLabel('Descripción');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Select('tipo');
        $e->setLabel('Tipo');
        $e->addMultiOption('-1','-- Seleccione Tipo --');
        $e->addMultiOptions($cats);
        $opc = array_keys($cats);
        $v = new Zend_Validate_InArray($opc);
        $e->addValidator($v);        
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Submit('submit');
        $e->setLabel('Enviar');
        $this->addElement($e);
        
        
    }
    
}

?>
