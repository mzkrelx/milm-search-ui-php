<?php
use Milm\Http_Utils;

/**
 * @group App
 */
class Test_Http_Utils extends Fuel\Core\TestCase
{
	/**
	 * クエリ文字列作成のテスト
	 */
	public function test_make_query_string()
	{
		$params = array(
			'a' => 1,
			'b' => 'ビー'
		);

		$actual = Http_Utils::make_query_string($params);

		$this->assertSame("?a=1&b=ビー", $actual);
	}

}