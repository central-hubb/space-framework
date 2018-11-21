<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class WidgetsController
 *
 * @package App\Controllers\Theme
 */
class WidgetsController extends Controller
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
	 * widgets.
	 */
	public function widgets()
	{
		$this->di->layout()->set('page_title', 'Widgets');
		$this->di->layout()->set('page_description', 'Reusable and flexible components serving specific functions');
		return $this->di->view('theme.widgets');
	}
	
	
}
