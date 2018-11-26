<?php

namespace App\Controllers\Docs;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class IndexController
 *
 * @package App\Controllers\Docs
 */
class IndexController extends Controller
{
	/**
	 * IndexController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('docs-beta');
	}

	/**
	 * installation.
	 */
	public function installation()
	{
		return $this->di->view('docs.getting-started.installation');
	}

	/**
	 * environments.
	 */
	public function environments()
	{
		return $this->di->view('docs.getting-started.environments');
	}

	/**
	 * configuration.
	 */
	public function configuration()
	{
		return $this->di->view('docs.getting-started.configuration');
	}

	/**
	 * directoryStructure.
	 */
	public function directoryStructure()
	{
		return $this->di->view('docs.getting-started.directory-structure');
	}

	/**
	 * spaceCli.
	 */
	public function spaceCli()
	{
		return $this->di->view('docs.getting-started.space-cli');
	}
}
