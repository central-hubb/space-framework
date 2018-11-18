<?php

namespace App\Library\Framework\Component;

/**
 * Class Asset
 *
 * @package App\Library\Framework
 */
class Panel
{
	/** @var string $title */
	protected $title = 'title';

	/** @var string $content */
	protected $content = 'content';

	/** @var string $cols */
	protected $cols = '4';

	/** @var bool $float */
	protected $float = true;

	/**
	 * getHtml.
	 *
	 * @return string
	 */
	public function getHtml()
	{
		$float = $this->float == true ? '' : 'float:none';

		$html  = '';

		$html .= '<div class="col-md-'.$this->cols.'" style="'.$float.'">';
		$html .= '<div class="panel">';
		$html .= '<div class="panel-heading">';
		$html .= '<h3 class="panel-title">'.$this->title.'</h3>';
		$html .= '</div>';
		$html .= '<div class="panel-body">';
		$html .= $this->content;
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';

		return $html;
	}

	/**
	 * getTitle
	 *
	 * @return string
	 */
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * setTitle
	 *
	 * @param string $title
	 *
	 * @return Panel
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
		return $this;
	}

	/**
	 * getContent
	 *
	 * @return string
	 */
	public function getContent(): string
	{
		return $this->content;
	}

	/**
	 * setContent
	 *
	 * @param string $content
	 *
	 * @return Panel
	 */
	public function setContent(string $content)
	{
		$this->content = $content;
		return $this;
	}

	/**
	 * getCols
	 *
	 * @return string
	 */
	public function getCols(): string
	{
		return $this->cols;
	}

	/**
	 * setCols
	 *
	 * @param string $cols
	 *
	 * @return Panel
	 */
	public function setCols(string $cols)
	{
		$this->cols = $cols;
		return $this;
	}

	/**
	 * getFloat
	 *
	 * @return bool
	 */
	public function getFloat(): bool
	{
		return $this->float;
	}

	/**
	 * setFloat
	 *
	 * @param bool $float
	 *
	 * @return Panel
	 */
	public function setFloat(bool $float)
	{
		$this->float = $float;
		return $this;
	}
}
