<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class ChartsController
 *
 * @package App\Controllers\Theme
 */
class ChartsController extends Controller
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
	 * chartjs.
	 */
	public function chartjs()
	{
		$this->di->layout()->set('page_title', 'Chart.js');
		$this->di->layout()->set('page_description', 'Simple yet flexible JavaScript charting for designers & developers');
		return $this->di->view('theme.charts.chartjs');
	}

	/**
	 * chartist.
	 */
	public function chartist()
	{
		$this->di->layout()->set('page_title', 'Chartist');
		$this->di->layout()->set('page_description', 'Highly customizable responsive simple charts.');
		return $this->di->view('theme.charts.chartist');
	}

	/**
	 * flot.
	 */
	public function flot()
	{
		$this->di->layout()->set('page_title', 'Flot charts');
		$this->di->layout()->set('page_description', 'Simple usage, attractive looks and interactive features.');
		return $this->di->view('theme.charts.flot');
	}

	/**
	 * sparkline.
	 */
	public function sparkline()
	{
		$this->di->layout()->set('page_title', 'Sparkline Charts');
		$this->di->layout()->set('page_description', 'Small inline charts');
		return $this->di->view('theme.charts.sparkline');
	}

	
}
