<?php

namespace App\Controllers\Backend;

use App\Library\Framework\Base\Controller;

/**
 * Class SocketController
 *
 * @package App\Controllers\Backend
 */
class SocketController extends Controller
{
	/**
	 * index.
	 */
	public function index()
	{
		return $this->di->view('backend.socket.index');
	}
}
