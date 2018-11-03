<?php

namespace App\Controllers\Docs;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class AdvancedController
 *
 * @package App\Controllers\Docs
 */
class AdvancedController extends Controller
{
	/**
	 * AdvancedController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('docs');
	}

	/**
	 * broadcasting.
	 */
	public function broadcasting()
	{
		return $this->di->view('docs.advanced.broadcasting');
	}

	/**
	 * cache.
	 */
	public function cache()
	{
		return $this->di->view('docs.advanced.cache');
	}

	/**
	 * events.
	 */
	public function events()
	{
		return $this->di->view('docs.advanced.events');
	}

	/**
	 * fileStorage.
	 */
	public function fileStorage()
	{
		return $this->di->view('docs.advanced.file-storage');
	}

	/**
	 * helpers.
	 */
	public function helpers()
	{
		return $this->di->view('docs.advanced.helpers');
	}

	/**
	 * mail.
	 */
	public function mail()
	{
		return $this->di->view('docs.advanced.mail');
	}

	/**
	 * notifications.
	 */
	public function notifications()
	{
		return $this->di->view('docs.advanced.notifications');
	}

	/**
	 * packageDevelopment.
	 */
	public function PackageDevelopment()
	{
		return $this->di->view('docs.advanced.package-development');
	}

	/**
	 * queues.
	 */
	public function queues()
	{
		return $this->di->view('docs.advanced.queues');
	}

	/**
	 * taskScheduling.
	 */
	public function taskScheduling()
	{
		return $this->di->view('docs.advanced.task-scheduling');
	}
}
