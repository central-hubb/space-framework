<?php

namespace App\Library\Framework;

/**
 * Class Space
 *
 * @package App\Library\Framework
 */
class Space
{
	/** @var array $di */
	protected $di = [];

	/** @var bool $debug */
	protected $debug = false;

	/**
	 * di constructor.
	 */
	public function __construct()
	{
		$this->di['asset'] = new Asset();
		$this->di['config'] = new Config();
		$this->di['environment'] = new Environment();
		$this->di['database'] = new Database();
		$this->di['log'] = new Log();
		$this->di['orm'] = new Orm();
		$this->di['request'] = new Request();
		$this->di['router'] = new Router($this->di['request']);
		$this->di['cache'] = new Cache();
		$this->di['session'] = new Session();
		$this->di['exception'] = new Exception();
		$this->di['layout'] = new Layout();
		$this->di['mail'] = new Mail();
		$this->di['controller'] = (new Controller($this, $this->di['router']->getRoute()['controller'], $this->di['router']->getRoute()['action']));
		$this->di['response'] = new Response($this->di['controller']->getLayout()->getResponseBody());
	}

	/**
	 * set.
	 *
	 * @param $className
	 * @param $classObject
	 */
	public function set($className, $classObject)
	{
		$this->di[$className] = $classObject;
	}

	/**
	 * get.
	 *
	 * @param $className
	 * @return mixed
	 */
	public function get($className)
	{
		return $this->di[$className];
	}

	/**
	 * init.
	 */
	public function init()
	{
		if($this->debug === false) {
			echo $this->di['response']->getResponseBody();
			exit;
		} else {
			$this->dump($this, true);
		}
	}

	/**
	 * dump.
	 *
	 * @param array $data
	 * @param bool $exit
	 */
	public function dump($data = [], $exit = false)
	{
		print '<pre>';
		print_r($data);
		print '</pre>';

		if($exit) {
			exit;
		}
	}

	/**
	 * asset.
	 *
	 * @return mixed
	 */
	public function asset()
	{
		return $this->di['asset'];
	}

	/**
	 * environment.
	 *
	 * @return mixed
	 */
	public function environment()
	{
		return $this->di['environment'];
	}

	/**
	 * exception.
	 *
	 * @param $message
	 * @param $code
	 * @return Exception
	 */
	public function exception($message, $code)
	{
		return $this->di['exception']->throw($message, $code);
	}

	/**
	 * log.
	 *
	 * @param $data
	 * @param string $file
	 * @return mixed
	 */
	public function log($data, $file = 'default')
	{
		return $this->di['log']->write($data, $file);
	}

	/**
	 * mail.
	 *
	 * @return mixed
	 */
	public function mail()
	{
		return $this->di['mail'];
	}


	/**
	 * view
	 *
	 * @param $viewName
	 * @param array $params
	 * @return View
	 */
	public function view($viewName, $params = [])
	{
		return $this->di['view'] = new View($viewName, $params);
	}

	/**
	 * layout.
	 *
	 * @return mixed
	 */
	public function layout()
	{
		return $this->di['layout'];
	}
}
