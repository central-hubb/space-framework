<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class UIController
 *
 * @package App\Controllers\Theme
 */
class UIController extends Controller
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
	 * sweetalert.
	 *
	 */
	public function sweetalert()
	{
		$this->di->layout()->set('page_title', 'Sweet Alert');
		$this->di->layout()->set('page_description', 'A beautiful, responsive and customizable replacement for Javasript\'s popup boxes.');
		return $this->di->view('theme.ui.sweetalert');
	}

	/**
	 * treeview.
	 *
	 */
	public function treeview()
	{
		$this->di->layout()->set('page_title', 'Tree View');
		$this->di->layout()->set('page_description', 'Interactive trees, easily extendable, themable and configurable. Try to right click node item to see popup menu.');
		return $this->di->view('theme.ui.treeview');
	}

	/**
	 * wizard.
	 *
	 */
	public function wizard()
	{
		$this->di->layout()->set('page_title', 'Wizard');
		$this->di->layout()->set('page_description', 'A wizard divides a complex goal into multiple steps by separating sub-tasks or content into panes.');
		return $this->di->view('theme.ui.wizard');
	}

	/**
	 * dragDropPanel.
	 *
	 */
	public function dragDropPanel()
	{
		$this->di->layout()->set('page_title', 'Drag & Drop Panel');
		$this->di->layout()->set('page_description', 'Reorder panels in layout with drag and drop feature');
		return $this->di->view('theme.ui.dragdrop-panel');
	}

	/**
	 * nestable.
	 */
	public function nestable()
	{
		$this->di->layout()->set('page_title', 'Netstable');
		$this->di->layout()->set('page_description', 'Drag & drop hierarchical list with mouse and touch compatibility');
		return $this->di->view('theme.ui.nestable');
	}

	/**
	 * gauge.
	 */
	public function gauge()
	{
		$this->di->layout()->set('page_title', 'Gauge');
		$this->di->layout()->set('page_description', 'Nice and clean gauges based on Raphael library for vector drawing.');
		return $this->di->view('theme.ui.gauge');
	}

	/**
	 * panels.
	 */
	public function panels()
	{
		$this->di->layout()->set('page_title', 'Panels');
		$this->di->layout()->set('page_description', 'Panel container for various requirements and use-case scenario.');
		return $this->di->view('theme.ui.panels');
	}

	/**
	 * progressbars.
	 */
	public function progressbars()
	{
		$this->di->layout()->set('page_title', 'Progress Bars');
		$this->di->layout()->set('page_description', 'Dynamic and static progress bars with various formats and styles.');
		return $this->di->view('theme.ui.progressbars');
	}

	/**
	 * tabs.
	 */
	public function tabs()
	{
		$this->di->layout()->set('page_title', 'Tabs');
		$this->di->layout()->set('page_description', 'Quick, dynamic tab functionality to transition through panes of local content, even via dropdown menus.');
		return $this->di->view('theme.ui.tabs');
	}

	/**
	 * buttons.
	 */
	public function buttons()
	{
		$this->di->layout()->set('page_title', 'Buttons');
		$this->di->layout()->set('page_description', 'A collection of buttons with various styles and functions.');
		return $this->di->view('theme.ui.buttons');
	}

	/**
	 * bootstrap.
	 */
	public function bootstrap()
	{
		$this->di->layout()->set('page_title', 'Bootstrap UI');
		$this->di->layout()->set('page_description', 'Custom styled standard Bootstrap UI.');
		return $this->di->view('theme.ui.bootstrap');
	}

	/**
	 * icons.
	 */
	public function icons()
	{
		$this->di->layout()->set('page_title', 'Icons');
		$this->di->layout()->set('page_description', '320+ icons from Themify and 650+ icons from Font Awesome.');
		return $this->di->view('theme.ui.icons');
	}

	
}
