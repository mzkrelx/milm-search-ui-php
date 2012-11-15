<?php
namespace Milm;

class Http_Utils
{
	/**
	 * 配列のキーと値から、?で始まるクエリ文字列を作成します。
	 *
	 * @param  array $array
	 * @return string
	 */
	public static function make_query_string($array)
	{
		if (!is_array($array) or empty($array)) {
			return '';
		}

		$query = '?';
		foreach ($array as $name => $value) {
			if ($query !== '?') {
				$query .= '&';
			}
			$query .= $name.'='.$value;
		}
		return $query;
	}
}