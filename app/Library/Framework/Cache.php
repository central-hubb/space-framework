<?php

namespace App\Library\Framework;

/**
 * Class Cache
 *
 * @package App\Library\Framework
 */
class Cache
{
	/** @var \Memcached $memcached */
	protected $memcached;

	/** @var string $host */
	protected $host = '127.0.0.1';

	/** @var int $port */
	protected $port = 11211;

	/**
	 * Cache constructor.
	 *
	 */
	public function __construct()
	{
		$this->memcached = new \Memcached();
		$this->memcached->addServer($this->host, $this->port);
	}

	/**
	 * set.
	 *
	 * @param $key
	 * @param $value
	 * @param int $expiration
	 */
	public function set($key, $value, $expiration = 86400)
	{
		$this->memcached->set($key, json_encode($value), $expiration) or die("cache keys could not be created");
	}

	/**
	 * get.
	 *
	 * @param $key
	 * @return bool
	 */
	public function get($key)
	{
		return json_decode($this->memcached->get($key)) or die("cache keys not found");
	}

	/**
	 * getHost
	 *
	 * @return string
	 */
	public function getHost(): string
	{
		return $this->host;
	}

	/**
	 * setHost
	 *
	 * @param string $host
	 *
	 * @return Cache
	 */
	public function setHost(string $host)
	{
		$this->host = $host;
		return $this;
	}

	/**
	 * getPort
	 *
	 * @return int
	 */
	public function getPort(): int
	{
		return $this->port;
	}

	/**
	 * setPort
	 *
	 * @param int $port
	 *
	 * @return Cache
	 */
	public function setPort(int $port)
	{
		$this->port = $port;
		return $this;
	}
}