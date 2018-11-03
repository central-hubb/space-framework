<?php

namespace App\Library\Framework;

/**
 * Class Router
 *
 * @package App\Library\Framework
 */
class Router extends Core
{
	/** @var Request $request */
	private $request;

	/** @var string $path */
	private $path = '../routes';

	/** @var array $routes */
	private $routes = [];

	/** @var array $route */
	private $route = [
		'uri' => '/',
		'controller' => 'Frontend\ErrorController',
		'action' => 'error404',
	];

	/**
	 * Router constructor.
	 *
	 * @param Request $request
	 */
	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->initRoutes();
		$this->initRoute();
	}

	/**
	 * initRoutes.
	 */
	public function initRoutes()
	{
		$files = scandir($this->path);

		if(!empty($files)) {
			foreach($files as $file) {
				if(!in_array($file, ['.', '..'])) {
					$this->routes = array_merge($this->routes, require_once $this->path.'/'.$file);
				}
			}
		}
	}

	/**
	 * initRoute.
	 */
	public function initRoute()
	{
		if(!empty($this->routes)) {
			foreach($this->routes as $route) {

				$uri = !empty($route['uri']) ? $route['uri'] : 'void';

				if($this->request->uri() == $uri) {
					$this->route = $route;
				}
			}
		}
	}

	/**
	 * getRequest
	 *
	 * @return Request
	 */
	public function getRequest(): Request
	{
		return $this->request;
	}

	/**
	 * setRequest
	 *
	 * @param Request $request
	 *
	 * @return Router
	 */
	public function setRequest(Request $request)
	{
		$this->request = $request;
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
	 * @return Router
	 */
	public function setPath(string $path)
	{
		$this->path = $path;
		return $this;
	}

	/**
	 * getRoutes
	 *
	 * @return array
	 */
	public function getRoutes(): array
	{
		return $this->routes;
	}

	/**
	 * setRoutes
	 *
	 * @param array $routes
	 *
	 * @return Router
	 */
	public function setRoutes(array $routes)
	{
		$this->routes = $routes;
		return $this;
	}

	/**
	 * getRoute
	 *
	 * @return array
	 */
	public function getRoute(): array
	{
		return $this->route;
	}

	/**
	 * setRoute
	 *
	 * @param array $route
	 *
	 * @return Router
	 */
	public function setRoute(array $route)
	{
		$this->route = $route;
		return $this;
	}
}
