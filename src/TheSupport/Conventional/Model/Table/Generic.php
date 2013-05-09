<?php
namespace TheSupport\Conventional\Model\Table;

use TheSupport\Conventional\Model\Base;
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
        return $this->getTableGateway()->selectWith($select);
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
            $this->select = new Select($this->getTableGateway()->getTable());
        }
        return $this->select;
    }

    public function save(Base $entity, $nullifyEmptyData = true)
    {

        $id = $entity->getId();
        $data = $entity->toArray($nullifyEmptyData);
        if(empty($id)) {
            $this->getTableGateway()->insert($data);
            $entity->setId($this->getTableGateway()->getLastInsertValue());
        }else {
            try{
                if($this->find($id)) {
                    $this->getTableGateway()->update($data, array($entity->getPk() => $entity->getId()));
                }
            }catch(Exception $e){
                throw new Exception("Trying to update not existing entity", 0, $e);
            }
        }


        return $entity;

    }

    public function find($id)
    {
        $model = $this->getModelObject();
        $rows = $this->getTableGateway()->select(
            array( $model->getPk() => $id )
        );
        if(!$rows) {
            throw new Exception("Could not find row $id");
        }
        return $rows->current();
    }

    /**
     * @return \ArrayObject
     */
    public function getModelObject()
    {
        return $this->getTableGateway()->getResultSetPrototype()->getArrayObjectPrototype();
    }

    /**
     * @return AbstractTableGateway
     */
    protected function getTableGateway()
    {
        return $this->tableGateway;
    }
}