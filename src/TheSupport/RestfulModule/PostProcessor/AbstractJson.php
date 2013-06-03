<?php

namespace TheSupport\RestfulModule\PostProcessor;

/**
 *
 */
abstract class AbstractJson extends AbstractPostProcessor
{
    public function process()
    {
        $result = \Zend\Json\Encoder::encode($this->_vars);

        $this->setResponse($result);

        $headers = $this->_response->getHeaders();
        $headers->addHeaderLine('Content-Type', 'application/json');
        $this->_response->setHeaders($headers);
    }

    /**
     * @param $result
     */
    protected function setResponse($result)
    {
        $this->_response->setContent($result);
    }
}