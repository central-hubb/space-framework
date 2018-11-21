<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class TablesController
 *
 * @package App\Controllers\Theme
 */
class TablesController extends Controller
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
	 * static.
	 */
	public function _static()
	{
		$this->di->layout()->set('page_title', 'Tables');
		$this->di->layout()->set('page_description', 'Simple tables based on Bootstrap.');
		return $this->di->view('theme.tables.static');
	}

	/**
	 * dynamic.
	 */
	public function dynamic()
	{
		$this->di->layout()->set('page_title', 'Dynamic Tables');
		$this->di->layout()->set('page_description', 'Tables with powerful features such as sorting, drag and drop column, filter and more.');
		return $this->di->view('theme.tables.dynamic');
	}
	
	
}
