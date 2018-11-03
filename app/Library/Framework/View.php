<?php

namespace App\Library\Framework;

/**
 * Class View
 *
 * @package App\Library\Framework
 */
class View extends Core
{
	/** @var string $path */
	private $path = '../resources/views/';

	/** @var $viewName */
	private $viewName;

	/** @var array $params */
	private $params = [];

	/** @var string $responseBody */
	private $responseBody = '';

	/**
	 * View constructor.
	 *
	 * @param $viewName
	 * @param array $params
	 * @throws \Exception
	 */
	public function __construct($viewName, $params = [])
	{
		$this->viewName = $viewName;
		$this->params = $params;

		$data = $params;

		ob_start();

		$fullFilename = $this->path.str_replace('.', '/', $this->viewName).'.php';

		if(!file_exists($fullFilename)){
			exception('view not found : '.$this->viewName, 500);
		}

		require $fullFilename;

		$this->responseBody = ob_get_contents();

		ob_end_clean();
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
	 * @return View
	 */
	public function setPath(string $path)
	{
		$this->path = $path;
		return $this;
	}

	/**
	 * getViewName
	 *
	 * @return mixed
	 */
	public function getViewName()
	{
		return $this->viewName;
	}

	/**
	 * setViewName
	 *
	 * @param mixed $viewName
	 *
	 * @return View
	 */
	public function setViewName($viewName)
	{
		$this->viewName = $viewName;
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
	 * @return View
	 */
	public function setResponseBody(string $responseBody)
	{
		$this->responseBody = $responseBody;
		return $this;
	}
}
