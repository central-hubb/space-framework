<?php

namespace App\Controllers\Backend;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class IndexController
 *
 * @package App\Controllers\Backend
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
		$this->di->layout()->setLayoutName('backend');
	}

	/**
	 * index.
	 */
	public function index()
	{
		return $this->di->view('backend.index.index');
	}
}
