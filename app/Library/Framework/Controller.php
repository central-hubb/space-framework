<?php

namespace App\Library\Framework;

/**
 * Class Controller
 *
 * @package App\Library\Framework
 */
class Controller extends Core
{
	/** @var Space $di */
	private $di;

	/** @var string $className */
	private $className = 'Frontend\ErrorController';

	/** @var string $actionName */
	private $actionName = 'error404';

	/** @var array $params */
	private $params = [];

	/** @var Layout $layout */
	private $layout;

	/**
	 * Controller constructor.
	 *
	 * @param Space $di
	 * @param $className
	 * @param $actionName
	 * @param array $params
	 */
	public function __construct(Space $di, $className, $actionName, $params = [])
	{
		$this->di = $di;
		$this->className = $className;
		$this->actionName = $actionName;
		$this->params = $params;

		$this->init();
	}

	/**
	 * execute.
	 *
	 * @return $this
	 */
	public function init()
	{
		$fullClassName = '\App\Controllers\\'.$this->className;

		if(!class_exists($fullClassName)) {
			$this->di->exception('controller class does not exist:'.$fullClassName, 500);
		}

		$class = new $fullClassName($this->di);
		$this->layout = $class->getDi()->get('layout');

		if(!method_exists($class, $this->actionName)) {
			$this->di->exception('action '.$this->actionName.'() not found in controller : '.$fullClassName,500);
		}

		$this->layout->setView(call_user_func_array(array($class, $this->actionName), $this->params));
		$this->layout->init();

		return $this;
	}

	/**
	 * getClassName
	 *
	 * @return string
	 */
	public function getClassName(): string
	{
		return $this->className;
	}

	/**
	 * setClassName
	 *
	 * @param string $className
	 *
	 * @return Controller
	 */
	public function setClassName(string $className)
	{
		$this->className = $className;
		return $this;
	}

	/**
	 * getActionName
	 *
	 * @return string
	 */
	public function getActionName(): string
	{
		return $this->actionName;
	}

	/**
	 * setActionName
	 *
	 * @param string $actionName
	 *
	 * @return Controller
	 */
	public function setActionName(string $actionName)
	{
		$this->actionName = $actionName;
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
	 * @return Controller
	 */
	public function setParams(array $params)
	{
		$this->params = $params;
		return $this;
	}

	/**
	 * getLayout
	 *
	 * @return Layout
	 */
	public function getLayout(): Layout
	{
		return $this->layout;
	}

	/**
	 * setLayout
	 *
	 * @param Layout $layout
	 *
	 * @return Controller
	 */
	public function setLayout(Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}
}
