<?php
namespace TheSupport\Test\Conventional\Model\Base\FieldOverriding;

use TheSupport\Conventional\Model\Base;

class BaseFieldOverridingTest extends \PHPUnit_Framework_TestCase {

    public function test_casting()
    {
        $model = new DummyModel(array('field'=>'foo', 'normal' => 'bar'));

        $this->assertEquals('foooverride', $model->field);
    }

    public function test_to_array_should_consider_overriden_getters()
    {
        $model = new DummyModel(array('field' => 1, 'normal' => '1'));
        $this->assertEquals(
            array('field' => '1override', 'normal' => '1'),
            $model->toArray()
        );
    }


}

class DummyModel extends Base {
    protected $attrs = array(
        "field",
        'normal',
    );

    public function getField()
    {
        return $this->getValue("field") . "override";
    }
}