<?php
namespace TheSupport\Conventional\Model\Table;

use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class Generic {
    /**
     * @var \Zend\Db\TableGateway\AbstractTableGateway
     */
    protected $tableGateway;

    public function __construct(AbstractTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }

    /**
     * @param \Zend\Db\Sql\Select $select
     * @param \Closure $with_select_do
     * @return \Zend\Db\ResultSet\ResultSet
     */
    public function fetchAll($select = null, \Closure $with_select_do = null)
    {
        $select = $select ?: new Select($this->tableGateway->table);
        if($with_select_do instanceof \Closure) {
            $with_select_do($select);
        }
        return $this->tableGateway->selectWith($select);
    }
}