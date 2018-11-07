<?php

namespace App\Library\Framework;

use Symfony\Component\Console\Command\Command as BaseCommand;

/**
 * Class Command
 *
 * @package App\Library\Framework
 */
class Command extends BaseCommand
{
	/** @var string $name */
	protected $name = 'app:command';

	/** @var string $description */
	protected $description = "base example";

	/**
	 * configure.
	 */
	protected function configure()
	{
		$this
			->setName($this->name)
			->setDescription($this->description);
	}


	/**
	 * getClassName.
	 *
	 * @param $filename
	 * @return mixed
	 */
	public function getClassName($filename)
	{
		$fp = fopen($filename, 'r');
		$class = $buffer = '';
		$i = 0;
		while (!$class) {
			if (feof($fp)) break;

			$buffer .= fread($fp, 512);
			$tokens = @token_get_all($buffer);

			if (strpos($buffer, '{') === false) continue;

			for (;$i<count($tokens);$i++) {
				if ($tokens[$i][0] === T_CLASS) {
					for ($j=$i+1;$j<count($tokens);$j++) {
						if ($tokens[$j] === '{') {
							return $tokens[$i+2][1];
						}
					}
				}
			}
		}
	}
}
