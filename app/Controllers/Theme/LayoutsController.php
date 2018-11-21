<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class LayoutsController
 *
 * @package App\Controllers\Theme
 */
class LayoutsController extends Controller
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
	 * topnav.
	 */
	public function topnav()
	{
		$this->di->layout()->set('page_title', 'Top Navigation');
		$this->di->layout()->set('page_description', 'Click the thumbnail to see other layouts.');
		return $this->di->view('theme.layouts.topnav');
	}

	/**
	 * minified.
	 */
	public function minified()
	{
		$this->di->layout()->set('page_title', 'Layout Minified');
		$this->di->layout()->set('page_description', 'Click the thumbnail to see other layouts.');
		return $this->di->view('theme.layouts.minified');
	}

	/**
	 * grid.
	 */
	public function grid()
	{
		$this->di->layout()->set('page_title', 'Grid');
		$this->di->layout()->set('page_description', 'Grid systems are used for creating page layouts through a series of rows and columns that house your content.');
		return $this->di->view('theme.layouts.grid');
	}

	
}
