<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class NotificationsController
 *
 * @package App\Controllers\Theme
 */
class NotificationsController extends Controller
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
	 * notifications.
	 */
	public function notifications()
	{
		$this->di->layout()->set('page_title', 'Notifications');
		$this->di->layout()->set('page_description', 'Customizable and stylish Gnome/Growl type non-blocking notifications.');
		return $this->di->view('theme.notifications');
	}
	
	
}
