<?php
/**
 * MilmSearch UI-PHP is a part of mailing list searching system,
 * user interface on the WEB.
 *
 * Copyright (C) 2013 MilmSearch Project.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this program.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * You can contact MilmSearch Project at mailing list
 * milm-search-public@lists.sourceforge.jp.
 *
 * @package    Milm
 * @version    0.1
 * @author     MilmSearch Project
 * @license    GPLv3 or later License
 * @copyright  Copyright (C) 2013 MilmSearch Project
 */
namespace Milm;

class Unicode
{
	/**
	 * UTF-8文字列をUnicodeエスケープする。ただし英数字と記号はエスケープしない。
	 *
	 * @param  string $str
	 * @return string
	 */
	public static function encode($str) {
		return preg_replace_callback("/((?:[^\x09\x0A\x0D\x20-\x7E]{3})+)/", "\Milm\encode_callback", $str);
	}

	/**
	 * Unicodeエスケープされた文字列をUTF-8文字列に戻す。
	 *
	 * @param  string $str
	 * @return string
	 */
	public static function decode($str) {
		return preg_replace_callback("/\\\\u([0-9a-zA-Z]{4})/", "\Milm\decode_callback", $str);
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


