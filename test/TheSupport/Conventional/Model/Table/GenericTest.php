<?php
namespace TheSupport\Test\Conventional\Model\Table;

use TheSupport\Conventional\Model\Table\Generic;
use Zend\Db\Sql\Select;

class GenericTest extends \PHPUnit_Framework_TestCase {
    public function test_should_allow_inner_select_access()
    {
        $gateway = $this->mockGateway();

        $table = new Generic($gateway);

        $select = $this->getMock('Zend\Db\Sql\Select', array('limit'), array(), '', false);

        $select->expects($this->once())
            ->method("limit")
            ->with(100)
        ;

        $table->setSelect($select);

        $table->fetchAll(function(Select $select){
            $select->limit(100);
        });


    }

    public function test_allows_select_injection()
    {
        $table = new Generic($this->mockGateway());

        $select = new Select("some_table");
        $table->setSelect($select);

        $this->assertEquals($select, $table->getSelect());
    }

    public function test_gets_default_select()
    {
        $table = new Generic($this->mockGateway('foo_table'));

        $select =  $table->getSelect();
        $this->assertInstanceOf("Zend\\Db\\Sql\\Select", $select);

        $table = $select->getRawState(Select::TABLE);
        $this->assertEquals("foo_table", $table);

    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function mockGateway($tableName = "whateva")
    {
        /**
         * return PHPUnit_Framework_MockObject_MockObject
         */
        $gateway = $this->getMock(
            "Zend\\Db\\TableGateway\\TableGateway",
            array('getTable', 'selectWith'), array(), '', false
        );
        $gateway->expects($this->any())
            ->method("getTable")
            ->will($this->returnValue($tableName));
        return $gateway;
    }
}