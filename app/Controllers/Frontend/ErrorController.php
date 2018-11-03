<?php

namespace App\Controllers\Frontend;

use App\Library\Framework\Base\Controller;

/**
 * Class ErrorController
 *
 * @package App\Controllers\Frontend
 */
class ErrorController extends Controller
{
	/**
	 * error404.
	 */
	public function error404()
	{
		return $this->di->view('frontend.errors.404');
	}
}
