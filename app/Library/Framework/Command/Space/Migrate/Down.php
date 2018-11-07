<?php

namespace App\Library\Framework\Command\Space\Migrate;

use App\Library\Framework\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Down
 *
 * @package App\Library\Framework\Command\Space
 */
class Down extends Command
{
	/** @var string $name */
	protected $name = 'migrate:down';

	/** @var string $description */
	protected $description = "Migrate Database downwards";

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
	 * execute.
	 *
	 * @param InputInterface $input
	 * @param OutputInterface $output
	 * @return false
	 */
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$path = './database/migrations';
		$files = scandir($path);

		$config = [
			'hostname' => env('DB_HOST', 'localhost'),
			'username' => env('DB_USERNAME', 'root'),
			'password' => env('DB_PASSWORD', 'root'),
			'database' => env('DB_DATABASE', 'space_mvc')
		];

		if(!empty($files)) {
			foreach($files as $file) {
				if(!in_array($file, ['.', '..'])) {
					$className = $this->getClassName($path.'/'.$file);
					require_once $path.'/'.$file;

					$sql = (new $className)->down();

					$pdo = new \PDO('mysql:host='.$config['hostname'].';dbname='.$config['database'], $config['username'], $config['password'], array(
						\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
						\PDO::ATTR_EMULATE_PREPARES => false
					));

					$pdo->beginTransaction();
					try{
						$stmt = $pdo->prepare($sql);
						$stmt->execute();
						$pdo->commit();

					} catch(\Exception $e){
						$output->writeln($e->getMessage());
						$pdo->rollBack();
					}
				}
			}
		}
	}
}