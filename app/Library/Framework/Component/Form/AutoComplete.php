<?php

namespace App\Library\Framework\Component\Form;

/**
 * Class Asset
 *
 * @package App\Library\Framework
 */
class AutoComplete
{
	/** @var string $type */
	protected $type = 'text';

	/** @var string $class */
	protected $class = 'form-control ui-autocomplete-input';

	/** @var string $placeholder */
	protected $placeholder = 'Try to type \'a\' or \'b\'';

	/** @var string $dataSource */
	protected $dataSource = '/api/component/auto-complete/demo1'; // url containing json array of values no keys required

	/**
	 * getHtml.
	 *
	 * @return string
	 */
	public function getHtml()
	{
		return '<input type="'.$this->type.'" class="'.$this->class.'"  placeholder="'.$this->placeholder.'" autocomplete="off"  data-source="'.$this->dataSource.'">';
	}

	/**
	 * getType
	 *
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}

	/**
	 * setType
	 *
	 * @param string $type
	 *
	 * @return AutoComplete
	 */
	public function setType(string $type)
	{
		$this->type = $type;
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
	 * @return AutoComplete
	 */
	public function setClass(string $class)
	{
		$this->class = $class;
		return $this;
	}

	/**
	 * getPlaceholder
	 *
	 * @return string
	 */
	public function getPlaceholder(): string
	{
		return $this->placeholder;
	}

	/**
	 * setPlaceholder
	 *
	 * @param string $placeholder
	 *
	 * @return AutoComplete
	 */
	public function setPlaceholder(string $placeholder)
	{
		$this->placeholder = $placeholder;
		return $this;
	}

	/**
	 * getDataSource
	 *
	 * @return string
	 */
	public function getDataSource(): string
	{
		return $this->dataSource;
	}

	/**
	 * setDataSource
	 *
	 * @param string $dataSource
	 *
	 * @return AutoComplete
	 */
	public function setDataSource(string $dataSource)
	{
		$this->dataSource = $dataSource;
		return $this;
	}
}
