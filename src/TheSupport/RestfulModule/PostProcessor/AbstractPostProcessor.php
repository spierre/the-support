<?php

namespace TheSupport\RestfulModule\PostProcessor;

/**
 *
 */
abstract class AbstractPostProcessor
{
	/**
	 * @var array|null
	 */
	protected $_vars = null;

	/**
	 * @var null|\Zend\Http\Response
	 */
	protected $_response = null;

	/**
	 * @var null|\Zend\Http\Request
	 */
	protected $_request = null;

	/**
	 * @param $vars
	 * @param \Zend\Http\Response $response
	 */
	public function __construct(\Zend\Http\Request $request, \Zend\Http\Response $response, $vars = null)
	{
		$this->_vars = $vars;
		$this->_response = $response;
        $this->_request = $request;
	}

	/**
	 * @return null|\Zend\Http\Response
	 */
	public function getResponse()
	{
		return $this->_response;
	}

    /**
     * @return null|\Zend\Http\Request
     */
    public function getRequest()
    {
        return $this->_request;
    }

	/**
	 * @abstract
	 */
	abstract public function process();
}