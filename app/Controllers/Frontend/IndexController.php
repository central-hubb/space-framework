<?php

namespace App\Controllers\Frontend;

use App\Library\Framework\Base\Controller;
use App\Models\User;

/**
 * Class IndexController
 *
 * @package App\Controllers\Frontend
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

		dump(User::query('show tables;'));

		return $this->di->view('frontend.index.index', [
			'testA1' => 'testA',
			'testA2' => 'testB',
			'testA3' => 'testC'
		]);
	}
}
