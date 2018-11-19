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
	 * productDetail.
	 */
	public function productDetail()
	{
		$this->di->layout()->set('page_title', 'Project Detail');
		$this->di->layout()->set('page_description', 'A detailed view about project information');
		return $this->di->view('theme.app-views.product-detail');
	}
}
