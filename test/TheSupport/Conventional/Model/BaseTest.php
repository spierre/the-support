<?php
namespace TheSupport\Test\Conventional\Model;

use TheSupport\Conventional\Model\Base;

class BaseTest extends \PHPUnit_Framework_TestCase {

    public function test_it_should_allow_initialization_with_empty_fields()
    {
        $model = new DummyModel();
        $this->assertEquals(null, $model->field);
    }

    public function test_it_should_allow_accessing_fields_by_getter_if_undefined()
    {
        $model = new DummyModel(array("field" => 23));

        $this->assertEquals(23, $model->getField());

    }
}

class DummyModel extends Base {
    protected $attrs = array("field");
}