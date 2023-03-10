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

namespace Application\Base;

/**
 *
 * Option
 *
 * @category Application\Base
 * @author guadalupe, chente
 */
class Option
{

    /**
     *
     * @var mixed
     */
    protected $value;

    /**
     *
     * @param mixed $value
     */
    public function __construct($value){
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function get(){
        return $this->value;
    }

    /**
     *
     * @param mixed $alternative
     * @return mixed
     */
    public function getOrElse($alternative){
        return $this->isDefined() ? $this->get() : $alternative;
    }

    /**
     *
     * @return mixed
     */
    public function getOrNull(){
        return $this->getOrElse(null);
    }

    /**
     *
     * @param callable $function
     * @return mixed
     */
    public function onNull($function){
        if ( $this->isNull() ){
            return call_user_func($function);
        }
        return null;
    }

    /**
     *
     * @param string $message
     * @throws \UnexpectedValueException
     * @return mixed
     */
    public function getOrThrow($message){
        if( $this->isNull() ){
            throw new \UnexpectedValueException($message);
        }
        return $this->get();
    }

    /**
     *
     * @param callable $onDefined
     * @return mixed
     */
    public function onDefined($function){
        if ( $this->isDefined() ){
            return call_user_func($function, $this->get());
        }
        return null;
    }

    /**
     *
     * @param callable $onNull
     * @param callable $onDefined
     * @return mixed
     */
    public function map($onNull, $onDefined){
        return $this->isNull() ? $this->onNull($onNull) : $this->onDefined($onDefined);
    }

    /**
     *
     * @param string $className
     * @return boolean
     */
    public function isInstanceOf($className){
        return is_a($this->get(), $className);
    }

    /**
     * @return boolean
     */
    public function isDefined(){
        return !$this->isNull();
    }

    /**
     * @return boolean
     */
    public function isNull(){
        return null == $this->value;
    }

}