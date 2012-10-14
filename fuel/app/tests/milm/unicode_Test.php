<?php
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