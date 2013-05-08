<?php
namespace TheSupport\Test\Conventional\Model\Table\Generic\Find;

use TheSupport\Conventional\Model\Table\Generic;
use TheSupport\Conventional\Model\Base;
use Zend\Db\ResultSet\ResultSet;

class GenericFindTest extends \PHPUnit_Framework_TestCase {


    public function test_find_should_call_select_for_pk()
    {
        $entityId = 666;
        $table = $this->mockTableWithExistingEntity($entityId);

        $this->assertInstanceOf(__NAMESPACE__ .'\DummyModel', $table->find(666));
    }


    public function test_find_should_throw_exception_if_no_results_found()
    {
        $entityId = 666;
        $table = $this->mockTableWithNotExistingEntity($entityId);

        $this->setExpectedException('\TheSupport\Conventional\Model\Table\Exception');

        $table->find(666);
    }

    /**
     * @param $entityId
     * @return \PHPUnit_Framework_MockObject_MockObject|Generic
     */
    private function mockTableWithExistingEntity($entityId)
    {
        /** @var \Zend\Db\TableGateway\TableGateway|\PHPUnit_Framework_MockObject_MockObject $tableGateway */
        $tableGateway = $this->getMock('\Zend\Db\TableGateway\TableGateway',
            array('select', 'getModelObject'), array(), '', false
        );

        /** @var \TheSupport\Conventional\Model\Table\Generic|\PHPUnit_Framework_MockObject_MockObject $table */
        $table = $this->getMock('\TheSupport\Conventional\Model\Table\Generic', array('getModelObject'), array($tableGateway));
        $table->expects($this->any())
            ->method('getModelObject')
            ->will($this->returnValue(new DummyModel()));

        /** @var \Zend\Db\ResultSet\ResultSet|\PHPUnit_Framework_MockObject_MockObject $set */
        $set = $this->getMock('\Zend\Db\ResultSet\ResultSet', array('current'), array(), '', false);
        $set->expects($this->any())
            ->method('current')
            ->will($this->returnValue(new DummyModel()));

        $tableGateway->expects($this->once())
            ->method('select')
            ->with(array('pkField' => $entityId))
            ->will($this->returnValue($set));
        return $table;
    }

    /**
     * @param $entityId
     * @return \PHPUnit_Framework_MockObject_MockObject|Generic
     */
    private function mockTableWithNotExistingEntity($entityId)
    {
        /** @var \Zend\Db\TableGateway\TableGateway|\PHPUnit_Framework_MockObject_MockObject $tableGateway */
        $tableGateway = $this->getMock('\Zend\Db\TableGateway\TableGateway',
            array('select', 'getModelObject'), array(), '', false
        );

        /** @var \TheSupport\Conventional\Model\Table\Generic|\PHPUnit_Framework_MockObject_MockObject $table */
        $table = $this->getMock('\TheSupport\Conventional\Model\Table\Generic', array('getModelObject'), array($tableGateway));
        $table->expects($this->any())
            ->method('getModelObject')
            ->will($this->returnValue(new DummyModel()));

        $tableGateway->expects($this->once())
            ->method('select')
            ->with(array('pkField' => $entityId))
            ->will($this->returnValue(null));
        return $table;
    }


}


class DummyModel extends Base {
    protected $attrs = array("field", "pkField");

    protected $pk = 'pkField';
}