<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class PagesController
 *
 * @package App\Controllers\Frontend
 */
class PagesController extends Controller
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
	 * profile.
	 */
	public function profile()
	{
		return $this->di->view('theme.pages.profile');
	}

	/**
	 * login.
	 */
	public function login()
	{
		return $this->di->view('theme.pages.login');
	}

	/**
	 * register.
	 */
	public function register()
	{
		return $this->di->view('theme.pages.register');
	}

	/**
	 * lockScreen.
	 */
	public function lockScreen()
	{
		return $this->di->view('theme.pages.lock-screen');
	}

	/**
	 * forgotPassword.
	 */
	public function forgotPassword()
	{
		return $this->di->view('theme.pages.forgot-password');
	}

	/**
	 * page404.
	 */
	public function page404()
	{
		return $this->di->view('theme.pages.page-404');
	}

	/**
	 * page500.
	 */
	public function page500()
	{
		return $this->di->view('theme.pages.page-500');
	}
}
