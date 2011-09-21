<?php

/**
 * Description of NoEquals
 *
 * @author Jesus Fabian
 */

class App_Validate_NoEquals extends Zend_Validate_Abstract
{

    protected $_pattern;
    protected $_message;
    const EQUALS_1 = 'is_equal_message1';
    const EQUALS_NO_ROOT = 'is_equal_message2';

    
    protected $_messageTemplates = array(
    self::EQUALS_1 => 'El contenido es igual al patron 1',
    self::EQUALS_NO_ROOT => 'No puedes ser root'
    );
    
    public function __construct($t)
    {
        $this->_pattern = $t;
    }
    
    public function isValid($value)
    {
        $value = (string) $value;
        $this->_setValue($value);
        
        if ($value != $this->_pattern && $value != 'root' ) {
            return true;
        } else if ($value == 'root') {
            $this->_error(self::EQUALS_NO_ROOT);
            return false;
        }else{
            $this->_error(self::EQUALS_1);
            return false;
        }
    }
}