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

    public function test_to_array_nullify_empty_fields_by_default()
    {
        $model = new DummyModel(array('field' => '', 'field2' => ""));
        $data = $model->toArray();
        $this->assertFalse(isset($data['field']));
        $this->assertFalse(isset($data['field2']));
    }

    public function test_toArray_allow_disabling_nullification()
    {
        $model = new DummyModel(array('field' => ''));
        $data = $model->toArray(false);
        $this->assertTrue($data['field'] === '');
    }
}

class DummyModel extends Base {
    protected $attrs = array("field", 'field2', 'id');
}