<?php

namespace App\Library\Framework;

/**
 * Class Exception
 *
 * @package App\Library\Framework
 */
class Exception extends \Exception
{
	/**
	 * throw.
	 *
	 * @param string $message
	 * @param int $code
	 * @param \Throwable|null $previous
	 */
	public function throw($message = "", $code = 0, \Throwable $previous = null)
	{
		echo json_encode([
			'exception' => [
				'message' => $message,
				'code' => $code
			]
		]);
		exit;
	}
}