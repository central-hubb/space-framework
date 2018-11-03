<?php

namespace App\Library\Framework;

/**
 * Class Session
 *
 * @package App\Library\Framework
 */
class Session
{
	/** @var $session */
	protected $session;

	/**
	 * Cache constructor.
	 *
	 */
	public function __construct()
	{
		if(!session_id()) {
			session_start();
			$this->session = $_SESSION;
		}
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
		$_SESSION[$key] = $value;
		return $this;
	}

	/**
	 * get.
	 *
	 * @param $key
	 * @return mixed
	 */
	public function get($key = null)
	{
		if(!$key) {
			return $_SESSION;
		}

		return $_SESSION[$key];
	}
}
