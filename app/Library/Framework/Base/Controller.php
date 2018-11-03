<?php

namespace App\Library\Framework\Base;

use App\Library\Framework\Space;

/**
 * Class Controller
 *
 * @package App\Library\Framework\Base
 */
class Controller
{
	/** @var Space $di */
	protected $di;

	/**
	 * Controller constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		$this->di = $di;
	}

	/**
	 * getDi
	 *
	 * @return Space
	 */
	public function getDi(): Space
	{
		return $this->di;
	}
}