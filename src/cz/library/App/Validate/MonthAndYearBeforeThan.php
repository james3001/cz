<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MonthAndYearBeforeThan
 *
 * @author eanaya
 */
class App_Validate_MonthAndYearBeforeThan extends Zend_Validate_Abstract
{
    const INVALID = 'invalid';

    protected $_monthBefore;
    protected $_yearBefore;
    protected $_monthAfter;
    protected $_yearAfter;
    protected $_singleDate;
    protected $_messageTemplates = array(
        self::INVALID => 'Las fechas son inválidas'
    );

    public function isValid($value, $context = null)
    {
         $a = $this->_setValue($value);

        if ( array_key_exists($this->getSingleDate(), $context) 
        && $context[$this->getSingleDate()] == '1' ) {
            return true;
        }
        
        if ( ! ( array_key_exists($this->getMonthBefore(), $context)
            && array_key_exists($this->getMonthAfter(), $context)
            && array_key_exists($this->getYearAfter(), $context)
            && array_key_exists($this->getYearBefore(), $context)
        ) ) {
            return false;
        }
        
        $dateBefore = new Zend_Date();
        $dateBefore->set(1, Zend_Date::DAY);
        $dateBefore->set($context[$this->getMonthBefore()], Zend_Date::MONTH);
        $dateBefore->set($context[$this->getYearBefore()], Zend_Date::YEAR);
        
        $dateAfter = new Zend_Date();
        $dateAfter->set(2, Zend_Date::DAY);
        $dateAfter->set($context[$this->getMonthAfter()], Zend_Date::MONTH);
        $dateAfter->set($context[$this->getYearAfter()], Zend_Date::YEAR);
        
        if ( $dateBefore->isEarlier($dateAfter)) {
            return true;
        }

        $this->_error(self::INVALID);
        return false;
    }

    public function __construct($options = array())
    {
        if ($options instanceof Zend_Config) {
            $options = $options->toArray();
        }
        
        if (!array_key_exists('month-before', $options)) {
            $options['month-before'] = 'inicio_mes';
        }
        $this->setMonthBefore($options['month-before']);
        
        if (!array_key_exists('year-before', $options)) {
            $options['year-before'] = 'inicio_ano';
        }
        $this->setYearBefore($options['year-before']);
        
        if (!array_key_exists('month-after', $options)) {
            $options['month-after'] = 'fin_mes';
        }
        $this->setMonthAfter($options['month-after']);
        
        if (!array_key_exists('year-after', $options)) {
            $options['year-after'] = 'fin_ano';
        }
        $this->setYearAfter($options['year-after']);
        
        if (!array_key_exists('single-date', $options)) {
            $options['single-date'] = 'en_curso';
        }
        $this->setSingleDate($options['single-date']);
        
    }
    
    /**
     * @return the $_monthBefore
     */
    public function getMonthBefore ()
    {
        return $this->_monthBefore;
    }

    /**
     * @return the $_yearBefore
     */
    public function getYearBefore ()
    {
        return $this->_yearBefore;
    }

    /**
     * @return the $_monthAfter
     */
    public function getMonthAfter ()
    {
        return $this->_monthAfter;
    }

    /**
     * @return the $_yearAfter
     */
    public function getYearAfter ()
    {
        return $this->_yearAfter;
    }

    /**
     * @param field_type $_monthBefore
     */
    public function setMonthBefore ($_monthBefore)
    {
        $this->_monthBefore = $_monthBefore;
    }

    /**
     * @param field_type $_yearBefore
     */
    public function setYearBefore ($_yearBefore)
    {
        $this->_yearBefore = $_yearBefore;
    }

    /**
     * @param field_type $_monthAfter
     */
    public function setMonthAfter ($_monthAfter)
    {
        $this->_monthAfter = $_monthAfter;
    }

    /**
     * @param field_type $_yearAfter
     */
    public function setYearAfter ($_yearAfter)
    {
        $this->_yearAfter = $_yearAfter;
    }
    /**
     * @return the $_singleDate
     */
    public function getSingleDate ()
    {
        return $this->_singleDate;
    }

    /**
     * @param field_type $_singleDate
     */
    public function setSingleDate ($_singleDate)
    {
        $this->_singleDate = $_singleDate;
    }

    
    

}