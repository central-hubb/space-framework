<?php

namespace App\Library\Framework;

/**
 * Class Asset
 *
 * @package App\Library\Framework
 */
class Asset
{
	/** @var array $assets */
	protected $assets = [];

	/**
	 * add.
	 *
	 * @param $type
	 * @param $url
	 * @param array $attributes
	 */
	public function add($type, $url, $attributes = [])
	{
		$this->assets[$type][] = [
			'type' => $type,
			'url' => $url,
			'attributes' => $attributes
		];
	}

	/**
	 * get.
	 *
	 * @param null $type
	 * @return array|mixed
	 */
	public function get($type = null)
	{
		if(!$type) {
			return $this->assets;
		} else {
			return $this->assets[$type];
		}
	}

	/**
	 * render.
	 *
	 * @param $type
	 * @param $url
	 * @param array $attributes
	 * @return string
	 */
	public function render($type, $url, $attributes = [])
	{
		switch($type)
		{
			case 'css';
				return '<link rel="stylesheet" type="text/css" href="'.$url.'" />';
				break;

			case 'js';
				return '<script type="text/javascript" src="'.$url.'"></script>';
				break;

			case 'img';
			return '<img src="'.$url.'" '.$this->attributesToHtml($attributes).'>';
				break;
		}
	}

	/**
	 * attributesToHtml.
	 *
	 * @param array $attributes
	 * @return string
	 */
	public function attributesToHtml($attributes = [])
	{
		$html = '';
		if(!empty($attributes)) {
			foreach($attributes as $key => $value){
				$html .= $key.'="'.$value.'" ';
			}
		}
		return rtrim($html, ' ');
	}
}
