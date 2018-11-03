<?php

namespace App\Controllers\Frontend;

use App\Library\Framework\Base\Controller;

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
		$mail = $this->di->mail();
		$mail->setSendTo(['mrdaniellee2020@gmail.com']);
		$mail->setSendFrom('mrdaniellee2020@local.mvc.com');
		$mail->send();

		$this->di->layout()->set('helloA', 'worldA');
		$this->di->layout()->set('helloB', 'worldB');
		$this->di->layout()->set('helloC', 'worldC');

		return $this->di->view('frontend.index.index', [
			'testA1' => 'testA',
			'testA2' => 'testB',
			'testA3' => 'testC'
		]);
	}
}
