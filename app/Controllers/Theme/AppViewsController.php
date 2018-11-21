<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class AppViewsController
 *
 * @package App\Controllers\Theme
 */
class AppViewsController extends Controller
{
	/**
	 * IndexController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('theme');
	}	

	/**
	 * projectDetail.
	 */
	public function projectDetail()
	{
		$this->di->layout()->set('page_title', 'Project Detail');
		$this->di->layout()->set('page_description', 'A detailed view about project information');
		return $this->di->view('theme.app-views.project-detail');
	}

	/**
	 * projects.
	 */
	public function projects()
	{
		$this->di->layout()->set('page_title', 'Projects');
		$this->di->layout()->set('page_description', 'List of project information summary');
		return $this->di->view('theme.app-views.projects');
	}

	/**
	 * inbox.
	 */
	public function inbox()
	{
		$this->di->layout()->set('page_title', 'Inbox');
		$this->di->layout()->set('page_description', 'You have <strong>8 unread messages</strong>');
		return $this->di->view('theme.app-views.inbox');
	}

	/**
	 * fileManager.
	 */
	public function fileManager()
	{
		$this->di->layout()->set('page_title', 'File Manager');
		$this->di->layout()->set('page_description', '<span class=\"text-danger\">You nearly reached storage limit capacity!</span>&nbsp;&nbsp;&nbsp;<a href=\"#\"><i class=\"fa fa-plus-circle\"></i> Upgrade Now</a>');
		return $this->di->view('theme.app-views.file-manager');
	}
}
