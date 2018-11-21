<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class MapsController
 *
 * @package App\Controllers\Theme
 */
class MapsController extends Controller
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
	 * jqvmap.
	 */
	public function jqvmap()
	{
		$this->di->layout()->set('page_title', 'Maps by JQVMap');
		$this->di->layout()->set('page_description', 'Vector map that uses resizable Scalable Vector Graphics (SVG) for modern browsers');
		return $this->di->view('theme.maps.jqvmap');
	}

	/**
	 * mapael.
	 */
	public function mapael()
	{
		$this->di->layout()->set('page_title', 'Maps by jQuery Mapael');
		$this->di->layout()->set('page_description', 'Ease the build of pretty data visualizations on dynamic vector maps.');
		return $this->di->view('theme.maps.mapael');
	}
	
	
}
