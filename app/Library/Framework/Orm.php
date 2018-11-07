<?php

namespace App\Library\Framework;

/**
 * Class Orm
 *
 * @package App\Library\Framework
 */
class Orm
{
	/** @var array $connections */
	protected $connections = [];

	/** @var  $config */
	protected $config;

	/**
	 * Orm constructor.
	 */
	public function __construct()
	{
		$connections = array(
			'default' => 'mysql://root:root@localhost/space_mvc'
		);

		\ActiveRecord\Config::initialize(function($cfg) use ($connections)
		{
			$cfg->set_model_directory('/workspace/www/space-mvc/app/Models');
			$cfg->set_connections($connections);
			$cfg->set_default_connection('default');
		});
	}
}
