<?php

/**
 * Description of Url
 *
 * @author Julio Florian
 */

class App_Validate_Url extends Zend_Validate_Abstract
{
    const INVALID_URL = 'invalidUrl';

    protected $_messageTemplates = array(
        self::INVALID_URL => "'%value%' no es una URL.",
    );

    public function isValid($value)
    {
        $valueString = (string) $value;
        $this->_setValue($valueString);
        
        if ($value == Application_Form_Paso1Postulante::$_defaultWebsite) {
            return true;
        }
        
        $a = strtolower(substr($value, 0, 3));
        
        if ($a == 'www') {
            $value = Application_Form_Paso1Postulante::$_defaultWebsite.$value;
        }
        
        if (!Zend_Uri::check($value)) {
            $this->_error(self::INVALID_URL);
            return false;
        }
    return true;
    exit;
    }
}