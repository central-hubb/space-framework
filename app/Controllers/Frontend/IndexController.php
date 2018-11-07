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

//		User::create([
//			'first_name' => 'Daniel',
//			'last_name' => 'Lee'
//		]);
//
//		dump(User::find('all'));

		return $this->di->view('frontend.index.index', [
			'testA1' => 'testA',
			'testA2' => 'testB',
			'testA3' => 'testC'
		]);
	}
}
