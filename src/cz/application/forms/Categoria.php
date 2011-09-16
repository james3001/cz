<?php

class Application_Form_Categoria extends Zend_Form 
{

    public function init() {
        
       
        parent::init();
        
        $e = new Zend_Form_Element_Text('nombre');
        $e->setRequired(true);
        $v = new Zend_Validate_StringLength(array('min' => 3, 'max' => 30));
        $e->addValidator($v);
        $e->addFilter(new Zend_Filter_StringTrim());
        $e->addFilter(new Zend_Filter_StringToLower());
        $e->setLabel('Nombre');
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Textarea('descripcion');
        $e->setLabel('Descripción');
        $e->setAttrib('cols', 40);
        $e->setAttrib('rows', 3);
        $v = new Zend_Validate_StringLength(array('min' => 3, 'max' => 180));
        $e->addValidator($v);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Submit('submit');
        $e->setLabel('Enviar');
        $this->addElement($e);
        
        
    }
    
}

?>
