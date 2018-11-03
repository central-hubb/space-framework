<?php

namespace App\Library\Framework;

/**
 * Class Response
 *
 * @package App\Library\Framework
 */
class Response extends Core
{
	/** @var string $responseBody */
	private $responseBody = '';

	/**
	 * Response constructor.
	 *
	 * @param $responseBody
	 */
	public function __construct($responseBody)
	{
		$this->responseBody = $responseBody;
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
	 * @return Response
	 */
	public function setResponseBody(string $responseBody)
	{
		$this->responseBody = $responseBody;
		return $this;
	}
}
