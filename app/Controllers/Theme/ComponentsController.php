<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class ComponentsController
 *
 * @package App\Controllers\Theme
 */
class ComponentsController extends Controller
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
	 * index.
	 */
	public function index()
	{
		return $this->di->view('theme.components.index');
	}
}
