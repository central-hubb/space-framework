<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class DashboardController
 *
 * @package App\Controllers\Frontend
 */
class DashboardController extends Controller
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
	 * dashboardV1.
	 */
	public function dashboardV1()
	{
		$this->di->layout()->set('page_title', 'Dashboard V1');
		$this->di->layout()->set('page_description', 'Admin dashboard template with drag and drop panel.');

		return $this->di->view('theme.dashboards.dashboard-v1');
	}

	/**
	 * dashboardV2.
	 */
	public function dashboardV2()
	{
		$this->di->layout()->set('page_title', 'Dashboard V2');
		$this->di->layout()->set('page_description', 'Growth monitor dashboard with colorful elements.');

		return $this->di->view('theme.dashboards.dashboard-v2');
	}

	/**
	 * dashboardV3.
	 */
	public function dashboardV3()
	{
		$this->di->layout()->set('page_title', 'Dashboard V3');
		$this->di->layout()->set('page_description', 'Simple and minimal dashboard.');

		return $this->di->view('theme.dashboards.dashboard-v3');
	}

	/**
	 * dashboardV4.
	 */
	public function dashboardV4()
	{
		$this->di->layout()->set('page_title', 'Dashboard V4');
		$this->di->layout()->set('page_description', 'Dashboard with top navigation layout and centered content.');

		return $this->di->view('theme.dashboards.dashboard-v4');
	}
}
