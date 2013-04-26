# Convention over configuration like stuff in Zend

## Models

    class MyModel extends TheSupport\Conventional\Model\Base
    {
        $attrs = array('id', 'name');
    }

will give you magin getters and setters for specified fields

## Tables

    TheSupport\Conventional\Model\Table\Generic

gives you fetchAll method with callback to manipulate inner select used for selectWith

    $table->fetchAll(function(Select $select){
        $select->limit(10);
    });

More to come (as needed)