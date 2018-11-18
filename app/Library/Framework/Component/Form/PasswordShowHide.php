<?php

namespace App\Library\Framework\Component\Form;

/**
 * Class PasswordShowHide
 *
 * @package App\Library\Framework\Component\Form
 */
class PasswordShowHide
{
	/** @var string $id */
	protected $id;

	/** @var string $class */
	protected $class;

	/** @var string $name */
	protected $name = 'password';

	/**
	 * getHtml.
	 *
	 * @return string
	 */
	public function getHtml()
	{
		return '<input type="text" id="'.$this->id.'" class="form-control input-password-show-hide '.$this->class.'" name="'.$this->name.'">';
	}

	/**
	 * getId
	 *
	 * @return string
	 */
	public function getId(): string
	{
		return $this->id;
	}

	/**
	 * setId
	 *
	 * @param string $id
	 *
	 * @return PasswordShowHide
	 */
	public function setId(string $id)
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * getClass
	 *
	 * @return string
	 */
	public function getClass(): string
	{
		return $this->class;
	}

	/**
	 * setClass
	 *
	 * @param string $class
	 *
	 * @return PasswordShowHide
	 */
	public function setClass(string $class)
	{
		$this->class = $class;
		return $this;
	}

	/**
	 * getName
	 *
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * setName
	 *
	 * @param string $name
	 *
	 * @return PasswordShowHide
	 */
	public function setName(string $name)
	{
		$this->name = $name;
		return $this;
	}
}
