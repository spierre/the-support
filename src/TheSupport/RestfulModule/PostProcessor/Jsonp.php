<?php
/**
 * User: gpawlik
 * To change this template use File | Settings | File Templates.
 */

namespace TheSupport\RestfulModule\PostProcessor;


class Json extends AbstractJson{
    /**
     * @param $result
     */
    protected function setResponse($result)
    {
        $callback = $this->getRequest()->getQuery('callback');
        $this->_response->setContent("$callback($result)");
    }
}