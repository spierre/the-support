<?php
namespace TheSupport\Test\Conventional\Model\Base\FieldOverriding;

use TheSupport\Conventional\Model\Base;

class BaseFieldOverridingTest extends \PHPUnit_Framework_TestCase {

    const CAST_FAIL = "field has not been casted to int";

    public function test_should_cast_types()
    {
        $model = new DummyModel(array('field' => '1'));
        $this->assertTrue(
            $model->field === 1,
            self::CAST_FAIL
        );
    }

    public function test_types_should_be_casted_on_set()
    {
        $model = new DummyModel();
        $model->field = '12';
        $this->assertTrue(
            $model->field === 12,
            self::CAST_FAIL
        );
    }

    public function test_types_should_be_strings_by_default()
    {
        $model = new DummyModel();
        $model->normal = 12;
        $this->assertTrue(
            $model->normal === '12',
            self::CAST_FAIL
        );
    }


}

class DummyModel extends Base {
    protected $attrs = array(
        "field" => array('type' => 'int'),
        'normal',
    );
}