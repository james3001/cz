<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PasswordConfirmation
 *
 * @author eanaya
 */
class App_Validate_PasswordConfirmation extends Zend_Validate_Abstract
{
    const NOT_MATCH = 'notMatch';

    protected $_matchField;
    protected $_messageTemplates = array(
        self::NOT_MATCH => 'Los passwords no coinciden'
    );

    public function isValid($value, $context = null)
    {
        $value = (string) $value;
        $this->_setValue($value);

        if ( $value == $context[$this->getMatchField()]) {
            return true;
        }

        $this->_error(self::NOT_MATCH);
        return false;
    }

    public function __construct($options = array())
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        if (!array_key_exists('match-field', $options)) {
            $options['match-field'] = 'pswd';
        }
        $this->setMatchField($options['match-field']);
    }

    public function getMatchField()
    {
        return $this->_matchField;
    }

    public function setMatchField($_matchField)
    {
        $this->_matchField = $_matchField;
    }

}