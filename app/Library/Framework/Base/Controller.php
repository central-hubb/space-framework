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

	/** @var $get */
	protected $get;

	/** @var $post */
	protected $post;

	/**
	 * Controller constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		$this->di = $di;
		$this->get = $this->getDi()->request()->get();
		$this->post = $this->getDi()->request()->post();
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

	/**
	 * get
	 *
	 * @return mixed
	 */
	public function get()
	{
		return $this->get;
	}


	/**
	 * getPost
	 *
	 * @return mixed
	 */
	public function getPost()
	{
		return $this->post;
	}
}