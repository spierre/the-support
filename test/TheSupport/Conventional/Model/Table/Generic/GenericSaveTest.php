<?php
namespace TheSupport\Test\Conventional\Model\Table\Generic\Save;

use TheSupport\Conventional\Model\Table\Exception;
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
        /** @var \TheSupport\Conventional\Model\Table\Generic|\PHPUnit_Framework_MockObject_MockObject $table */
        $table = $this->getMock('\TheSupport\Conventional\Model\Table\Generic', array('find'), array($tableGateway));
        $table->expects($this->once())
            ->method('find')
            ->with(12)
            ->will($this->returnValue(new DummyModel()));

        $entity = new DummyModel(array("field" => 'fieldValue', 'pkField' => 12));

        $table->save($entity);
    }

    public function test_save_should_throw_exception_if_entity_is_not_present_in_db()
    {
        $entityId = 9001;
        /** @var \Zend\Db\TableGateway\TableGateway|\PHPUnit_Framework_MockObject_MockObject $tableGateway */
        $tableGateway = $this->getMock('\Zend\Db\TableGateway\TableGateway',
            array('insert'), array(), '', false
        );

        /** @var \TheSupport\Conventional\Model\Table\Generic|\PHPUnit_Framework_MockObject_MockObject $table */
        $table = $this->getMock('\TheSupport\Conventional\Model\Table\Generic', array('find'), array($tableGateway));
        $table->expects($this->once())
            ->method('find')
            ->with($entityId)
            ->will($this->throwException(new Exception()));

        $entity = new DummyModel(array("field" => 'fieldValue', 'pkField' => $entityId));

        $this->setExpectedException('TheSupport\Conventional\Model\Table\Exception');

        $table->save($entity);
    }

    public function test_should_nullify_empty_data_by_default()
    {
        /** @var \Zend\Db\TableGateway\TableGateway|\PHPUnit_Framework_MockObject_MockObject $tableGateway */
        $tableGateway = $this->getMock('\Zend\Db\TableGateway\TableGateway',
            array('insert'), array(), '', false
        );

        /** @var \TheSupport\Conventional\Model\Table\Generic|\PHPUnit_Framework_MockObject_MockObject $table */
        $table = $this->getMock('\TheSupport\Conventional\Model\Table\Generic', array('find'), array($tableGateway));

        /** @var DummyModel|\PHPUnit_Framework_MockObject_MockObject $entity */
        $entity = $this->getMock(__NAMESPACE__ . '\DummyModel', array('toArray'),
            array(array("field" => '', 'pkField' => ''))
        );
        $entity->expects($this->once())
            ->method('toArray')
            ->with(true);

        $tableGateway->expects($this->once())
            ->method('insert');

        $table->save($entity);
    }
    public function test_should_cancel_nullification_of_empty_datat()
    {
        /** @var \Zend\Db\TableGateway\TableGateway|\PHPUnit_Framework_MockObject_MockObject $tableGateway */
        $tableGateway = $this->getMock('\Zend\Db\TableGateway\TableGateway',
            array('insert'), array(), '', false
        );

        /** @var \TheSupport\Conventional\Model\Table\Generic|\PHPUnit_Framework_MockObject_MockObject $table */
        $table = $this->getMock('\TheSupport\Conventional\Model\Table\Generic', array('find'), array($tableGateway));

        /** @var DummyModel|\PHPUnit_Framework_MockObject_MockObject $entity */
        $entity = $this->getMock(__NAMESPACE__ . '\DummyModel', array('toArray'),
            array(array("field" => '', 'pkField' => ''))
        );
        $entity->expects($this->once())
            ->method('toArray')
            ->with(false);

        $tableGateway->expects($this->once())
            ->method('insert');

        $table->save($entity, false);
    }



}


class DummyModel extends Base {
    protected $attrs = array("field", "pkField");

    protected $pk = 'pkField';
}