<?php
namespace TheSupport\Test\Conventional\Model\Table\Generic\Save;

use TheSupport\Conventional\Model\Table\Generic;
use TheSupport\Conventional\Model\Base;
use Zend\Db\ResultSet\ResultSet;

class GenericSaveTest extends \PHPUnit_Framework_TestCase {


    public function test_save_should_call_insert_if_pk_is_not_known()
    {
        /** @var \Zend\Db\TableGateway\TableGateway|\PHPUnit_Framework_MockObject_MockObject $tableGateway */
        $tableGateway = $this->getMock('\Zend\Db\TableGateway\TableGateway',
            array('insert'), array(), '', false
        );
        $tableGateway->expects($this->once())
            ->method("insert")
            ->with(array("field" => 'fieldValue', 'pkField' => null));

        $table = new Generic($tableGateway);
        $entity = new DummyModel(array("field" => 'fieldValue'));

        $table->save($entity);

    }

    public function test_save_should_call_update_if_pk_is_known()
    {
        /** @var \Zend\Db\TableGateway\TableGateway|\PHPUnit_Framework_MockObject_MockObject $tableGateway */
        $tableGateway = $this->getMock('\Zend\Db\TableGateway\TableGateway',
            array('update'), array(), '', false
        );
        $tableGateway->expects($this->once())
            ->method('update')
            ->with(
                array('field' => 'fieldValue', 'pkField' => 12),
                array('pkField' => 12)
            );

        $table = new Generic($tableGateway);
        $entity = new DummyModel(array("field" => 'fieldValue', 'pkField' => 12));

        $table->save($entity);
    }

//    public function test_save_should_call_insert_if_entity_is_not_present_in_db()
//    {
//        $this->markTestSkipped("to implement");
//    }


}


class DummyModel extends Base {
    protected $attrs = array("field", "pkField");

    protected $pk = 'pkField';
}