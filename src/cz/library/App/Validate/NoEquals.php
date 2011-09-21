<?php

/**
 * Description of NoEquals
 *
 * @author Jesus Fabian
 */

class App_Validate_NoEquals extends Zend_Validate_Abstract
{

    protected $_message;
    const EQUALS = 'is_equal_message';
    
    protected $_messageTemplates = array(
    self::EQUALS => 'El contenido es igual al patron',
    );
    
    public function __construct($message)
    {
        $this->_message = $message;
    }
    
    public function isValid($value)
    {
        $value = (string) $value;
        $this->_setValue($value);
        
        if ($value != $this->_message) {
            return true;
        } else {
            $this->_error(self::EQUALS);
            return false;
        }
    }
}