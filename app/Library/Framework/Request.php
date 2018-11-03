<?php

namespace App\Library\Framework;

/**
 * Class Request
 *
 * @package App\Library\Framework
 */
class Request extends Core
{
	/** @var string $uri */
	private $uri = '/';

	/** @var string $method */
	private $method = 'get';

	/** @var array $get */
	private $get = [];

	/** @var array $post */
	private $post = [];

	/**
	 * Request constructor.
	 */
	public function __construct()
	{
		$this->uri = !empty($_SERVER['REQUEST_URI']) ? explode('?', $_SERVER['REQUEST_URI'])[0] : null;
		$this->method = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : null;
		$this->get = !empty($_GET) ? $_GET : [];
		$this->post = !empty($_POST) ? $_POST : [];
	}

	/**
	 * uri
	 *
	 * @return string
	 */
	public function uri(): string
	{
		return $this->uri;
	}

	/**
	 * method
	 *
	 * @return string
	 */
	public function method(): string
	{
		return $this->method;
	}

	/**
	 * get
	 *
	 * @return array
	 */
	public function get(): array
	{
		return $this->get;
	}

	/**
	 * post
	 *
	 * @return array
	 */
	public function post(): array
	{
		return $this->post;
	}
}
