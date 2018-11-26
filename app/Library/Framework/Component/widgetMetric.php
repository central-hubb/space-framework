<?php

namespace App\Library\Framework\Component;

/**
 * Class widgetMetric
 *
 * @package App\Library\Framework\Component\
 */
class widgetMetric
{
	/** @var string $title */
	protected $title = 'title';

	/** @var string $cols */
	protected $cols = '3';

	/** @var string $cols */
	protected $smallCols = '6';

	/** @var bool $change */
	protected $change = true;

	/** @var string $background */
	protected $background;

	/** @var string $image */
	protected $image;

	/** @var string $value */
	protected $value;

	/** @var string $value */
	protected $ChangeValue;

	/**
	 * getHtml.
	 *
	 * @return string
	 */
	public function getHtml()
	{
		$changeIcon = $this->change == true ? 'up' : 'down';
		$changeIndicator = $this->change == true ? 'green' : 'red';
		$changeValue = $this->change == true ? '+' : '-';
		$html = '';
		$html .= '<div class="col-md-'.$this->cols.' col-sm-'.$this->smallCols.'">';
		$html .= '<div class="widget widget-metric_1 animate">';
		$html .= '<span class="icon-wrapper '.$this->background.'">';
		$html .= '<i class="fa '.$this->image.'">';
		$html .= '</i>';
		$html .= '</span>';
		$html .= '<div class="right">';
		$html .= '<span class="value">';
		$html .= $this->value;
		$html .= ' <i class="change-icon change-'.$changeIcon.' fa fa-sort-'.$changeIcon.' text-indicator-'.$changeIndicator.'">';
		$html .= '</i>';
		$html .= '</span>';
		$html .= '<span class="title">';
		$html .= $this->title;
		$html .= ' <span class="change text-indicator-'.$changeIndicator.'">';
		$html .= '('.$changeValue.' '.$this->changeValue.')';
		$html .= '</span>';
		$html .= '</span>';
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
	 * @return widgetMetric
	 */
	public function setTitle(string $title)
	{
		$this->title = $title;
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
	 * @return widgetMetric
	 */
	public function setCols(string $cols)
	{
		$this->cols = $cols;
		return $this;
	}

	/**
	 * getSmallCols
	 *
	 * @return string
	 */
	public function getSmallCols(): string
	{
		return $this->smallCols;
	}

	/**
	 * setSmallCols
	 *
	 * @param string $smallCols
	 *
	 * @return widgetMetric
	 */
	public function setSmallCols(string $smallCols)
	{
		$this->smallCols = $smallCols;
		return $this;
	}

	/**
	 * getChange
	 *
	 * @return bool
	 */
	public function getChange(): bool
	{
		return $this->change;
	}

	/**
	 * setChange
	 *
	 * @param bool $change
	 *
	 * @return widgetMetric
	 */
	public function setChange(bool $change)
	{
		$this->change = $change;
		return $this;
	}

	/**
	 * getBackground
	 *
	 * @return string
	 */
	public function getBackground(): string
	{
		return $this->background;
	}

	/**
	 * setBackground
	 *
	 * @param string $background
	 *
	 * @return widgetMetric
	 */
	public function setBackground(string $background)
	{
		$this->background = $background;
		return $this;
	}

	/**
	 * getImage
	 *
	 * @return string
	 */
	public function getImage(): string
	{
		return $this->image;
	}

	/**
	 * setImage
	 *
	 * @param string $image
	 *
	 * @return widgetMetric
	 */
	public function setImage(string $image)
	{
		$this->image = $image;
		return $this;
	}

	/**
	 * getValue
	 *
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	/**
	 * setValue
	 *
	 * @param string $value
	 *
	 * @return widgetMetric
	 */
	public function setValue(string $value)
	{
		$this->value = $value;
		return $this;
	}

	/**
	 * getChangeValue
	 *
	 * @return string
	 */
	public function getChangeValue(): string
	{
		return $this->changeValue;
	}

	/**
	 * setChangeValue
	 *
	 * @param string $changeValue
	 *
	 * @return widgetMetric
	 */
	public function setChangeValue(string $changeValue)
	{
		$this->changeValue = $changeValue;
		return $this;
	}
}
