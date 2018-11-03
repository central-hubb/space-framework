<?php

namespace App\Library\Framework;

/**
 * Class Layout
 *
 * @package App\Library\Framework
 */
class Layout extends Core
{
	/** @var string $path */
	private $path = '../resources/layouts/';

	/** @var $layoutName */
	private $layoutName;

	/** @var array $params */
	private $params = [];

	/** @var View $view */
	private $view;

	/** @var string $responseBody */
	private $responseBody = '';

	/**
	 * Layout constructor.
	 *
	 * @param string $layoutName
	 * @param array $params
	 */
	public function __construct($layoutName = 'frontend', $params = [])
	{
		$this->layoutName = $layoutName;
		$this->params = $params;
	}

	/**
	 * init.
	 */
	public function init()
	{
		$data = $this->params;
		$content = $this->view->getResponseBody();

		ob_start();
		require $this->path.str_replace('.', '/', $this->layoutName).'.php';
		$this->responseBody = ob_get_contents();
		ob_end_clean();
		return $this;
	}

	/**
	 * get.
	 *
	 * @param $key
	 * @return mixed
	 */
	public function get($key)
	{
		return $this->params[$key];
	}

	/**
	 * set.
	 *
	 * @param $key
	 * @param $value
	 * @return $this
	 */
	public function set($key, $value)
	{
		$this->params[$key] = $value;
		return $this;
	}

	/**
	 * getPath
	 *
	 * @return string
	 */
	public function getPath(): string
	{
		return $this->path;
	}

	/**
	 * setPath
	 *
	 * @param string $path
	 *
	 * @return Layout
	 */
	public function setPath(string $path)
	{
		$this->path = $path;
		return $this;
	}

	/**
	 * getLayoutName
	 *
	 * @return mixed
	 */
	public function getLayoutName()
	{
		return $this->layoutName;
	}

	/**
	 * setLayoutName
	 *
	 * @param mixed $layoutName
	 *
	 * @return Layout
	 */
	public function setLayoutName($layoutName)
	{
		$this->layoutName = $layoutName;
		return $this;
	}

	/**
	 * getParams
	 *
	 * @return array
	 */
	public function getParams(): array
	{
		return $this->params;
	}

	/**
	 * setParams
	 *
	 * @param array $params
	 *
	 * @return Layout
	 */
	public function setParams(array $params)
	{
		$this->params = $params;
		return $this;
	}

	/**
	 * getView
	 *
	 * @return View
	 */
	public function getView(): View
	{
		return $this->view;
	}

	/**
	 * setView
	 *
	 * @param View $view
	 *
	 * @return Layout
	 */
	public function setView(View $view)
	{
		$this->view = $view;
		return $this;
	}

	/**
	 * getResponseBody
	 *
	 * @return string
	 */
	public function getResponseBody(): string
	{
		return $this->responseBody;
	}

	/**
	 * setResponseBody
	 *
	 * @param string $responseBody
	 *
	 * @return Layout
	 */
	public function setResponseBody(string $responseBody)
	{
		$this->responseBody = $responseBody;
		return $this;
	}
}
