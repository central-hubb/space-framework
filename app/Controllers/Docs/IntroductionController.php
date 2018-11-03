<?php

namespace App\Controllers\Docs;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class IntroductionController
 *
 * @package App\Controllers\Docs
 */
class IntroductionController extends Controller
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
	 * whatIsSpace.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function whatIsSpace()
	{
		return $this->di->view('docs.introduction.what-is-space');
	}
}
