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

    protected $values = array();

    private function setValue($fieldName, $value)
    {
        $this->values[$fieldName] = $this->cast($fieldName, $value);
    }

    private function getValue($fieldName)
    {
        return isset($this->values[$fieldName])? $this->cast($fieldName, $this->values[$fieldName]): null;
    }

    private function hasValue($fieldName)
    {
        return isset($this->values[$fieldName]);
    }

    /**
     * @var string Primary key name
     */
    protected $pk = 'id';

    /**
     * @return mixed
     * @note no combined primary keys supported
     */
    public function getId() {
        return $this->hasValue($this->getPk())? $this->getValue($this->getPk()): null;
    }

    /**
     * @param mixed $value
     */
    public function setId($value){
        $this->{$this->getPk()} = $value;
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
            if($this->hasField($name)) {
                $this->setValue($name, $this->cast($name, $value));
            }
        }else{
            $this->$method($value);
        }
    }

    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (('mapper' == $name) || !method_exists($this, $method)) {
            if($this->hasField($name)) {
                return $this->getValue($name);
            }
        }
        return $this->$method();
    }

    public function __call($name, $arguments)
    {
        if( strpos($name, 'get')== 0) {
            $attr = strtolower( substr($name, 3, strlen($name)) );
            return $this->getValue($attr);
        }
    }

    public function __construct($options = array())
    {
        $this->setOptions($options);
    }


    public function setOptions(array $options)
    {
        foreach ($options as $key => $value) {
            $this->setValue($key, $value);
        }
        return $this;
    }

    public function toArray($nullifyEmptyStrings = true)
    {
        $data = array();
        foreach($this->attrs as $key => $field) {
            if(is_array($field)) {
                $field = $key;
            }
            if(!empty($this->values[$field]) || !$nullifyEmptyStrings) {
                $data[$field] = $this->$field;
            }
        }
        return $data;
    }

    public function exchangeArray($data)
    {
        $this->setOptions($data);
    }

    private function cast($fieldName, $value)
    {
        $fieldDefinition = isset($this->attrs[$fieldName])? $this->attrs[$fieldName] : null;
        if(is_array($fieldDefinition) && isset($fieldDefinition['type']) && $fieldDefinition['type'] === 'int') {
            return (int)$value;
        }
        return (string)$value;
    }

    /**
     * @param $name
     * @return bool
     */
    private function hasField($name)
    {
        return in_array($name, $this->attrs) || in_array($name, array_keys($this->attrs));
    }
}