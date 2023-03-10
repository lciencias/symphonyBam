<?php
/**
 * PCS Mexico
 *
 * Symphony Help Desk
 *
 * @copyright Copyright (c) PCS Mexico (http://pcsmexico.com)
 * @author    guadalupe, chente, $LastChangedBy$
 * @version   2
 */

namespace Application\Filter;

/**
 *
 * BaseFilter
 * @author chente
 *
 */
class BaseFilter
{

    /**
     *
     * @var array
     */
    protected $elements = array();

    /**
     * @var Zend_Filter_StringTrim
     */
    private static $stringTrim;

    /**
     * @var Zend_Filter_Interface
     */
    private static $ucwords;

    /**
     *
     * @var Zend_Filter_Interface
     */
    private static $nullFilter;

    /**
     *
     */
    public function __construct(){}

    /**
     * isValid
     * @param array $array
     * @return array
     */
    public function filter(array $array)
    {
        $newArray = array();
        foreach( $this->toArray() as $field  => $filter ){
            $newArray[$field] = $filter->filter($array[$field]);
        }
        return $newArray;
    }

     /**
     * @param string $fieldName
     * @return \Zend_Filter
     */
    public function getFor($fieldName){
         if( !isset($this->elements[$fieldName]) ){
             throw new \InvalidArgumentException("No existe el validator ". $fieldName);
         }
         return $this->elements[$fieldName];
    }

    /**
     * @return array
     */
    public function toArray(){
        return $this->elements;
    }

    /**
     * @return \Zend_Filter_Inteface
     */
    public static function getNullFilter(){
        if( null == self::$nullFilter ){
            self::$nullFilter = new \Zend_Filter();
        }
        return self::$nullFilter;
    }

    /**
     * @return \Zend_Filter_Inteface
     */
    public static function getStringTrim(){
        if( null == self::$stringTrim ){
            self::$stringTrim = new \Zend_Filter_StringTrim();
        }
        return self::$stringTrim;
    }

    /**
     * @return \Zend_Filter_Inteface
     */
    public static function getUcwords(){
        return self::getNullFilter();

        /*if( null == self::$ucwords ){
            self::$ucwords = new \Zend_Filter_Callback(function($value){
                return ucwords(strtolower($value));
            });
        }
        return self::$ucwords;
        */
    }

}
