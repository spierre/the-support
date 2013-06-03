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
class Iterator2ArrayDecorator {

    /**
     * @var \Iterator
     */
    private $iterator;

    public function __construct(\Iterator $iterator)
    {
        $this->iterator = $iterator;
    }

    public function toArray()
    {
        $array = array();
        foreach($this->iterator as $key => $val) {
            $array[$key] = $val;
        }
        return $array;
    }

}