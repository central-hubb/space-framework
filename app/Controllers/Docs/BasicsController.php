<?php

namespace App\Controllers\Docs;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class IndexController
 *
 * @package App\Controllers\Docs
 */
class BasicsController extends Controller
{
	/**
	 * BasicsController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('docs');
	}

	/**
	 * routing.
	 */
	public function routing()
	{
		return $this->di->view('docs.basics.routing');
	}

	/**
	 * middleware.
	 */
	public function middleware()
	{
		return $this->di->view('docs.basics.middleware');
	}

	/**
	 * csrf.
	 */
	public function csrf()
	{
		return $this->di->view('docs.basics.csrf');
	}

	/**
	 * controllers.
	 */
	public function controllers()
	{
		return $this->di->view('docs.basics.controllers');
	}

	/**
	 * requests.
	 */
	public function requests()
	{
		return $this->di->view('docs.basics.requests');
	}

	/**
	 * responses.
	 */
	public function responses()
	{
		return $this->di->view('docs.basics.responses');
	}

	/**
	 * views.
	 */
	public function views()
	{
		return $this->di->view('docs.basics.views');
	}

	/**
	 * session.
	 */
	public function session()
	{
		return $this->di->view('docs.basics.session');
	}

	/**
	 * validation.
	 */
	public function validation()
	{
		return $this->di->view('docs.basics.validation');
	}

	/**
	 * errorHandling.
	 */
	public function errorHandling()
	{
		return $this->di->view('docs.basics.error-handling');
	}

	/**
	 * logging.
	 */
	public function logging()
	{
		return $this->di->view('docs.basics.logging');
	}
}
