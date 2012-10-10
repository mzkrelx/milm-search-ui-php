<?php
class Model_Unicode
{
	/**
	 * UTF-8文字列をUnicodeエスケープする。ただし英数字と記号はエスケープしない。
	 *
	 * @param  string $str
	 * @return string
	 */
	public static function encode($str) {
		return preg_replace_callback("/((?:[^\x09\x0A\x0D\x20-\x7E]{3})+)/", "encode_callback", $str);
	}

	/**
	 * Unicodeエスケープされた文字列をUTF-8文字列に戻す。
	 *
	 * @param  string $str
	 * @return string
	 */
	public static function decode($str) {
		return preg_replace_callback("/\\\\u([0-9a-zA-Z]{4})/", "decode_callback", $str);
	}

}

function encode_callback($matches) {
	$char = mb_convert_encoding($matches[1], "UTF-16", "UTF-8");
	$escaped = "";
	for ($i = 0, $l = strlen($char); $i < $l; $i += 2) {
		$escaped .=  "\u" . sprintf("%02x%02x", ord($char[$i]), ord($char[$i+1]));
	}
	return $escaped;
}

function decode_callback($matches) {
	$char = mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UTF-16");
	return $char;
}

