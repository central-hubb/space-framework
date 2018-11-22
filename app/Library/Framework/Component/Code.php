<?php

namespace App\Library\Framework\Component;

/**
 * Class Code
 *
 * @package App\Library\Framework\Component
 */
class Code
{
	/** @var string $code */
	protected $code = 'code example';

	/**
	 * getHtml.
	 *
	 * @param null $code
	 * @return string
	 */
	public function getHtml($code = null)
	{
		if(!empty($code)) {
			$this->code = $code;
		}

		$html = '';

		$html .= '<pre class="language-php">';
		$html .= '<code class="language-php">';
		$html .= $this->code;
		$html .= '</code>';
		$html .= '</pre>';

		return $html;
	}

	/**
	 * getHtmlStatic.
	 *
	 * @param null $html
	 * @return string
	 */
	public static function getHtmlStatic($html = null)
	{
		$class = new self();
		return $class->getHtml($html);
	}

	/**
	 * getCode
	 *
	 * @return string
	 */
	public function getCode(): string
	{
		return $this->code;
	}

	/**
	 * setCode
	 *
	 * @param string $code
	 *
	 * @return Code
	 */
	public function setCode(string $code)
	{
		$this->code = $code;
		return $this;
	}
}