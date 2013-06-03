<?php
/**
 * User: gpawlik
 * To change this template use File | Settings | File Templates.
 */

namespace TheSupport\RestfulModule\PostProcessor;


class JsonP extends AbstractJson{
    /**
     * @param $result
     */
    protected function setResponse($result)
    {
        $callback = $this->getRequest()->getQuery('jsonp-callback');
        $this->getResponse()->setContent("$callback($result)");
    }
}