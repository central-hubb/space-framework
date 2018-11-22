<?php

namespace App\Controllers\Theme;

use App\Library\Framework\Base\Controller;
use App\Library\Framework\Space;

/**
 * Class FormController
 *
 * @package App\Controllers\Theme
 */
class FormController extends Controller
{
	/**
	 * IndexController constructor.
	 *
	 * @param Space $di
	 */
	public function __construct(Space $di)
	{
		parent::__construct($di);
		$this->di->layout()->setLayoutName('theme');
	}

	/**
	 * inputs.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function inputs()
	{
		return $this->di->view('theme.forms.inputs');
	}

	/**
	 * multiSelect.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function multiSelect()
	{
		return $this->di->view('theme.forms.multi-select');
	}

	/**
	 * inputPickers.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function inputPickers()
	{
		return $this->di->view('theme.forms.input-pickers');
	}

	/**
	 * select2.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function select2()
	{
		return $this->di->view('theme.forms.select2');
	}

	/**
	 * xEditable.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function xEditable()
	{
		return $this->di->view('theme.forms.x-editable');
	}

	/**
	 * dragDropUpload.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function dragDropUpload()
	{
		return $this->di->view('theme.forms.drag-drop-upload');
	}

	/**
	 * layouts.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function layouts()
	{
		return $this->di->view('theme.forms.layouts');
	}

	/**
	 * validation.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function validation()
	{
		return $this->di->view('theme.forms.validation');
	}

	/**
	 * textEditor.
	 *
	 * @return \App\Library\Framework\View
	 */
	public function textEditor()
	{
		return $this->di->view('theme.forms.text-editor');
	}
}
