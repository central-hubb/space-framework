<?php

namespace App\Controllers\Api\Component;

use App\Library\Framework\Base\Controller;

/**
 * Class AutoCompleteController
 *
 * @package App\Controllers\Api\Component
 */
class AutoCompleteController extends Controller
{
	/**
	 * demo1.
	 *
	 * @return string
	 */
	public function demo1()
	{
		$term = !empty($_GET['term']) ? $_GET['term'] : null;
		$data = [
			'a',
			'b',
			'c',
			'd',
			'e',
			'f',
			'g',
			'h',
			'i',
			'cat',
			'dog',
			'cow',
		];

		if($term) {
			$response = array_search($term, $data);
			return json_encode([$data[$response]]);
		} else {
			return json_encode($data);
		}
	}

	/**
	 * demo2.
	 *
	 * @return string
	 */
	public function demo2()
	{
		$term = !empty($_GET['term']) ? $_GET['term'] : null;

		$data = [
			'1',
			'2',
			'3',
			'4',
			'5',
			'6',
			'7',
			'8',
			'9',
			'10',
			'11',
			'12',
		];

		if($term) {
			$response = array_search($term, $data);
			return json_encode([$data[$response]]);
		} else {
			return json_encode($data);
		}
	}
}
