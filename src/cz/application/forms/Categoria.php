<?php

class Application_Form_Categoria extends Zend_Form 
{

    public function init() {
        
       
        parent::init();
        
        $e = new Zend_Form_Element_Text('nombre');
        $e->setRequired(true);
        $v = new Zend_Validate_StringLength(array('min' => 3, 'max' => 30));
        $e->addValidator($v);
        $e->addValidator(new App_Validate_NoEquals('aoc'));
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
        $v = new App_Validate_PasswordConfirmation();
        $v->setMatchField('nombre');
        //$e->addValidator($v);
        $this->addElement($e);
        
        $e = new Zend_Form_Element_Submit('submit');
        $e->setLabel('Enviar');
        $this->addElement($e);
        
    }
    
    
    public function parametrosNombrados(){
        $db = $_categoria->getAdapter();
        $db = Zend_Db_Table::getDefaultAdapter();
        $sql = "SELECT * FROM categoria WHERE id > :id_min AND id < :id_max ";
        $stmt = $db->query($sql,array(':id_min'=>2,':id_max'=>4));
        echo get_class($stmt);        
        var_dump($stmt->fetchAll());
    }
    
}

?>
