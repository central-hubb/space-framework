<?php

namespace App\Controllers\Backend;

use App\Library\Framework\Base\Controller;

/**
 * Class IndexController
 *
 * @package App\Controllers\Backend
 */
class IndexController extends Controller
{
	/**
	 * index.
	 */
	public function index()
	{
		$this->di->layout()->set('helloA', 'worldA');
		$this->di->layout()->set('helloB', 'worldB');
		$this->di->layout()->set('helloC', 'worldC');

		return $this->di->view('backend.index.index', [
			'testA1' => 'testA',
			'testA2' => 'testB',
			'testA3' => 'testC'
		]);
	}
}
