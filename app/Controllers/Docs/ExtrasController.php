<?php

namespace App\Controllers\Docs;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class ExtrasController
 *
 * @package App\Controllers\Docs
 */
class ExtrasController extends Controller
{
	/**
	 * IndexController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('docs');
	}

	/**
	 * mailingList.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function mailingList()
	{
		if(!empty($this->post['email'])) {
			\App\Models\System\MailingList::create([
				'email' => $this->post['email'],
			]);
		}

		$results = \App\Models\System\MailingList::all();
		return $this->di->view('docs.extras.mailing-list', ['results' => $results]);
	}

	/**
	 * supportTicket.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function supportTicket()
	{
		return $this->di->view('docs.extras.support-ticket');
	}

}
