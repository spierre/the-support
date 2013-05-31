<?php
namespace TheSupport\Test\Conventional\Model\Base\Base;

use TheSupport\Conventional\Model\Base;

class BaseTest extends \PHPUnit_Framework_TestCase {

    public function test_it_should_allow_initialization_with_empty_fields()
    {
        $model = new DummyModel();
        $this->assertEquals("overrided", $model->field);
    }

}

class DummyModel extends Base {
    protected $attrs = array("field", 'field2', 'id');

    public function getField()
    {
        return "overrided";
    }
}