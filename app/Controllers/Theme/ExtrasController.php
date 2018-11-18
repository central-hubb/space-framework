<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class ExtrasController
 *
 * @package App\Controllers\Frontend
 */
class ExtrasController extends Controller
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
	 * typography.
	 */
	public function typography()
	{
		return $this->di->view('theme.extras.typography');
	}
}
