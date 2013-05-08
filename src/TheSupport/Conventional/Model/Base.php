<?php
namespace TheSupport\Conventional\Model;

/**
 * Base model outsourcing standrd magic get's and set's
 * Class Base
 * @package ZendSupportUtils\Model
 */
abstract class Base {

    /**
     * Override this in your model
     * If you specify attributes it will be used with set, get and toArray method
     * @var array $attrs - Accessible attributes to DB fields matching
     */
    protected $attrs = array();

    /**
     * @var string Primary key name
     */

    /**
     * @return mixed
     * @note no combined primary keys supported
     */
    public function getId() {
        return $this->{$this->getPk()};
    }

    /**
     * @return string Primary key name
     */
    public function getPk()
    {
        return $this->pk;
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            if(in_array($name, $this->attrs)) {
                $this->$name = $value;
            }
        }else{
            $this->$method($value);
        }
    }

    public function __get($name)
    {
        $method = 'get' . $name;
        if (('mapper' == $name) || !method_exists($this, $method)) {
            if(in_array($name, $this->attrs)) {
                return isset($this->$name)? $this->$name: null;
            }
        }
        return $this->$method();
    }

    public function __call($name, $arguments)
    {
        if( strpos($name, 'get')== 0) {
            $attr = strtolower( substr($name, 3, strlen($name)) );
            return $this->$attr;
        }
    }

    public function __construct($options = array())
    {
        $this->setOptions($options);
    }


    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $this->$key = $value;
        }
        return $this;
    }

    public function toArray($nullifyEmptyStrings = true)
    {
        $data = array();
        foreach($this->attrs as $field) {
            if(empty($this->field) && $nullifyEmptyStrings) {
                $this->field = null;
            }
            $data[$field] = $this->$field;
        }
        return $data;
    }

    public function exchangeArray($data)
    {
        $this->setOptions($data);
    }
}