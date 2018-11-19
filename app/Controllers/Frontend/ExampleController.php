<?php

namespace App\Controllers\Frontend;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;


/**
 * Class ExampleController
 *
 * @package App\Controllers\Frontend
 */
class ExampleController extends Controller
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
	 * page1.
	 */
	public function page1()
	{
		$this->di->layout()->set('page_title', 'Page 1');
		$this->di->layout()->set('page_description', 'This is page one');

		return $this->di->view('frontend.examples.page1');
	}

	/**
	 * page2.
	 */
	public function page2()
	{
		$this->di->layout()->set('page_title', 'Page 2');
		$this->di->layout()->set('page_description', 'This is page one');

		return $this->di->view('frontend.examples.page2');
	}
}
