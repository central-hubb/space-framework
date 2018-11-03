<?php

namespace App\Library\Framework;

/**
 * Class Log
 *
 * @package App\Library\Framework
 */
class Log
{
	/** @var $session */
	protected $path = '../logs';

	/**
	 * write.
	 *
	 * @param $data
	 * @param string $file
	 */
	public function write($data, $file = 'default')
	{
		$fh = fopen($this->path.'/'.$file.'.txt', 'a') or die("can't open file");
		$data = is_array($data) || is_object($data) ? json_encode($data) : $data;
		fwrite($fh, date('Y-m-d H:i:s').' : '.$data."\n");
		fclose($fh);
	}
}
