<?php

namespace App\Controllers\Docs;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class DatabaseController
 *
 * @package App\Controllers\Docs
 */
class DatabaseController extends Controller
{
	/**
	 * DatabaseController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('docs');
	}

	/**
	 * gettingStarted.
	 */
	public function gettingStarted()
	{
		return $this->di->view('docs.database.getting-started');
	}

	/**
	 * conventions.
	 */
	public function conventions()
	{
		return $this->di->view('docs.database.conventions');
	}

	/**
	 * basicCRUD.
	 */
	public function basicCrud()
	{
		return $this->di->view('docs.database.basic-crud');
	}

	/**
	 * finders.
	 */
	public function finders()
	{
		return $this->di->view('docs.database.finders');
	}

	/**
	 * queryBuilder.
	 */
	public function queryBuilder()
	{
		return $this->di->view('docs.database.query-builder');
	}

	/**
	 * pagination.
	 */
	public function pagination()
	{
		return $this->di->view('docs.database.pagination');
	}

	/**
	 * migrations.
	 */
	public function migrations()
	{
		return $this->di->view('docs.database.migrations');
	}

	/**
	 * requests.
	 */
	public function seeding()
	{
		return $this->di->view('docs.database.seeding');
	}

	/**
	 * relationships.
	 */
	public function relationships()
	{
		return $this->di->view('docs.database.relationships');
	}

	/**
	 * redis.
	 */
	public function redis()
	{
		return $this->di->view('docs.database.redis');
	}
}
