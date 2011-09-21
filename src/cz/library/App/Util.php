<?php

/**
 * Description of Util
 *
 * @author eanaya
 */
class Util
{
    private $_dniTorucFixedValues = array(5,4,3,2,7,6,5,4,3,2);
    
    public function dni2ruc(String $dni)
    {
        $dni = str_pad($dni, 8, '0', STR_PAD_LEFT);
        if (strlen($dni) == 8) {
            throw new Zend_Exception("El DNI debe tener 8 dígitos");
        }
        $sum = 0;
        foreach ( $this->_dniTorucFixedValues as $key => $value ) {
            $sum += intval($dni[$key]) * $value;
        }
        $validationDigit = 11 - ($sum % 11);
        return '10' . $dni . $validationDigit;
    }
}
