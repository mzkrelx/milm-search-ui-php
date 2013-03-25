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
use Milm\Unicode;

/**
 * @group App
 */
class Test_Unicode extends Fuel\Core\TestCase
{
	/**
	 * ユニコードエスケープされた文字列をデコードするテスト
	 *
	 * @param mixed  $str    decodeメソッドに渡すもの
	 * @param mixed  $expect デコード後になるべきもの
	 * @dataProvider decode_provider テストデータ供給メソッド名
	 */
	public function test_decode($str, $expect)
	{
		$actual = Unicode::decode($str);
		$this->assertSame($expect, $actual);
	}

	/**
	 * デコードテストのテストデータを返します。
	 *
	 * @return array 変換する文字列と、変換後になるべきものの配列の配列
	 */
	public function decode_provider()
	{
		return array(
			array('\u7533\u8acb\u8005\u306e\u540d\u524d', '申請者の名前'),
			array(1, '1'),
			array(null, ''),
			array('', ''),
			array(array(), array())

		);
	}

	/**
	 * 文字列をユニコードエスケープにエンコードするテスト
	 *
	 * @param mixed  $str    encodeメソッドに渡すもの
	 * @param mixed  $expect エンコード後になるべきもの
	 * @dataProvider encode_provider テストデータ供給メソッド名
	 */
	public function test_encode($str, $expect)
	{
		$actual = Unicode::encode($str);
		$this->assertSame($expect, $actual);
	}

	/**
	 * エンコードテストのテストデータを返します。
	 *
	 * @return array 変換する文字列と、変換後になるべきものの配列の配列
	 */
	public function encode_provider()
	{
		return array(
			array('申請者の名前', '\u7533\u8acb\u8005\u306e\u540d\u524d'),
			array(1, '1'),
			array(null, ''),
			array('', ''),
			array(array(), array())
		);
	}

}