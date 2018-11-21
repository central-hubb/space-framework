<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class SubmenuController
 *
 * @package App\Controllers\Theme
 */
class SubmenuController extends Controller
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
	 * submenu.
	 */
	public function submenu()
	{
		$this->di->layout()->set('page_title', 'Another Menu Level');
		$this->di->layout()->set('page_description', 'Submenu page in multilevel menu demo');
		return $this->di->view('theme.submenu');
	}
	
	
}
