<?php
/**
 * User: gpawlik
 * To change this template use File | Settings | File Templates.
 */
namespace TheSupport\Utils;

/**
 * Class Iterator2ArrayDecorator
 * @package TheSupport\Utils
 * decorate any iterator with toArray method
 */
class Iterator2ArrayDecorator implements \Iterator{

    const REINDEX_ITEMS = 1;
    /**
     * @var \Iterator
     */
    private $iterator;

    private $_reindexItems = false;

    public function __construct(\Iterator $iterator, $flags = 0)
    {
        $this->iterator = $iterator;
        $this->_reindexItems = $flags & self::REINDEX_ITEMS;
    }

    public function toArray()
    {
        $array = array();
        foreach($this->iterator as $key => $val) {
            if($this->_reindexItems) {
                $array[] = $val;
            }else {
                $array[$key] = $val;
            }
        }
        return $array;
    }

    public function __call($methodName, $args)
    {
        call_user_func_array(array($this, $methodName), $args);
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        $this->iterator->current();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        $this->iterator->next();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        $this->iterator->key();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        $this->iterator->valid();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->iterator->rewind();
    }
}