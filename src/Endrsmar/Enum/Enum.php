<?php

/**
 *
 * Copyright (c) 2017 Martin Endršt (endrst.martin@gmail.com)
 *
 * For the full copyright and license information, please view the file LICENSE that was distributed with this source code.
 */
namespace Endrsmar\Enum;

use Exception;
use InvalidArgumentException;
use ReflectionClass;

/**
 * @author Martin Endršt <endrst.martin@gmail.com>
 */
abstract class Enum {
    
    /**
     * Reflection cache
     * @var array
     */
    protected static $_cache = [];
    
    /**
     * Constant's name
     * @var string
     */
    protected $name;
    
    /**
     * Constant's value
     * @var mixed
     */
    protected $value;
    
//  ========== INTERFACE ==========
    
    /**
     * @param mixed $val
     * @throws Exception
     */
    public function __construct($val){
        $calledClass = static::class;
        if ($calledClass == Enum::class){
            throw new Exception("Enum can not be instantiated directly");
        }
        if (!$calledClass::isValidValue($val)){
            throw new Exception("$val is not a valid value for $calledClass");
        }
        $this->value = $val;
        $this->name = $calledClass::nameFor($val);
    }
    
    /**
     * Perfoms equality check with either other Enum or with a value of said enum
     * @param mixed $tested
     * @return bool
     * @throws InvalidArgumentException
     */
    public function is($tested) : bool {
        $calledClass = static::class;
        if ($tested instanceof Enum) {
            return $calledClass == get_class($tested) && $this->value == $tested->getValue();
        } elseif (!$this->isValidValue($tested)){
            throw new InvalidArgumentException("$tested is not a valid value for $calledClass");
        } else {
            return $this->value === $tested;
        }
    }
    
    /**
     * Retrieves value
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }
    
    /**
     * Retrieves name for the value
     * @return string
     */
    public function getName() {
        return $this->name;
    }
    
//  ========== STATIC INTERFACE ==========
    
    /**
     * Checks if the name exists
     * @param string $name
     * @return bool
     */
    public static function isValidName(string $name) : bool {
        return isset(static::getConsts()[$name]) || in_array($name, array_keys(static::getConsts()));
    }
    
    /**
     * Checks if the value is present in enum
     * @param mixed $value
     * @return bool
     */
    public static function isValidValue($value) : bool {
        return in_array($value, static::getConsts());
    }
    
    /**
     * Retrieves name of given value
     * @param mixed $value
     * @throws InvalidArgumentException
     * @return string
     */
    public static function nameFor($value) : string {
        if (!static::isValidValue($value)){
            throw new InvalidArgumentException("Value is not a valid value for ".static::class);
        }
        foreach (static::getConsts() as $name => $val){
            if ($val == $value) {
                return $name;
            }
        }
    }
    
    /**
     * Retrieves value for given name
     * @param string $name
     * @throws InvalidArgumentException
     * @return mixed
     */
    public static function valueOf(string $name) {
        if (!static::isValidName($name)){
            throw new InvalidArgumentException("There is no value with name $name in ".static::class);
        }
        return static::getConsts()[$name];
    }
    
    /**
     * Represents enum as assoc array
     * @return array
     */
    public static function asArray() : array {
        return static::getConsts();
    }
    
    /**
     * Retrieves constants
     * @return array
     */
    private static function getConsts() : array {
        if (static::class == Enum::class){
            throw new Exception("Enum can not be used directly");
        }
        if (!isset(static::$_cache[static::class])){
            static::buildCache(static::class);
        }
        return static::$_cache[static::class];
    }
    
    /**
     * Builds cache for called class
     * @param string $calledClass
     */
    private static function buildCache() {
        $reflection = new ReflectionClass(static::class);
        static::$_cache[static::class] = $reflection->getConstants();
    }
    
    /**
     * Magic method for construction of Enum objects from const names
     * @param string $methodName
     * @param array $args
     * @return Enum
     * @throws InvalidArgumentException
     */
    public static function __callStatic($methodName, $args) : Enum{
        $calledClass = static::class;
        return new $calledClass(static::valueOf($methodName));
    }
    
}
