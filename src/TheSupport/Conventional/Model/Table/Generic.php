<?php
namespace TheSupport\Conventional\Model\Table;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class Generic {
    /**
     * @var \Zend\Db\TableGateway\AbstractTableGateway
     */
    protected $tableGateway;

    /**
     * @var \Zend\Db\Sql\Select
     */
    protected $select;

    public function __construct(AbstractTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param \Zend\Db\Sql\Select $select
     * @param \Closure $with_select_do
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll(\Closure $with_select_do = null)
    {
        $select = $this->getSelect();
        if($with_select_do instanceof \Closure) {
            $with_select_do($select);
        }
        return $this->tableGateway->selectWith($select);
    }

    /**
     * @param Select $select
     */
    public function setSelect(Select $select)
    {
        $this->select = $select;
    }

    /**
     * @return Select
     */
    public function getSelect()
    {
        if($this->select == null) {
            $this->select = new Select($this->tableGateway->getTable());
        }
        return $this->select;
    }
}