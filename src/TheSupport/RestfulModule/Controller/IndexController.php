<?php
namespace TheSupport\RestfulModule\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;

class IndexController extends AbstractRestfulController{

    /**
     * Create a new resource
     *
     * @param  mixed $data
     * @return mixed
     */
    public function create($data)
    {
        throw new \Exception("Guess what? Not implemented");
    }

    /**
     * Delete an existing resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function delete($id)
    {
        throw new \Exception("WTF! this is not implemented?!?!");
    }

    /**
     * Return single resource
     *
     * @param  mixed $id
     * @return mixed
     */
    public function get($id)
    {
        return array(
            "name" => "YourResource", "id" => 123,
            "what-is-that" => "This it your 1st resource serverd by your app",
            "note" => "please remember - it is just an example.",
            "info" => "no matter what ID you are using use you get this resource... sry"
        );

    }

    /**
     * Return list of resources
     *
     * @return mixed
     */
    public function getList()
    {
        return array(
            "index" =>
            array(
                1 => "Res1",
                2 => "Res2",
            ),
            "_error" => false,
            "info" => "try index/123",
            "other+stuff" => array(
                "to-get-error" => "try index/1 with DELETE verb"
            )
        );
    }

    /**
     * Update an existing resource
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return mixed
     */
    public function update($id, $data)
    {
        throw new \Exception("This one is not implelmented");
    }
}