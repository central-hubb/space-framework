<?php

namespace App\Controllers\Docs;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class VideoController
 *
 * @package App\Controllers\Docs
 */
class VideoController extends Controller
{
	/**
	 * IndexController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('docs');
	}

	/**
	 * index.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function index()
	{
		return $this->di->view('docs.videos.index');
	}

	/**
	 * installWamp.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function installWamp()
	{
		return $this->di->view('docs.videos.install-wamp');
	}

	/**
	 * installPhpStorm.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function installPhpStorm()
	{
		return $this->di->view('docs.videos.install-php-storm');
	}

	/**
	 * installSourceTree.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function installSourceTree()
	{
		return $this->di->view('docs.videos.install-source-tree');
	}

	/**
	 * githubMultipleUsers.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function githubMultipleUsers()
	{
		return $this->di->view('docs.videos.github-multiple-users');
	}

	/**
	 * downloadSpaceMvc.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function downloadSpaceMvc()
	{
		return $this->di->view('docs.videos.download-space-mvc');
	}

}
