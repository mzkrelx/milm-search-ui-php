<?php
/**
 * テストのサンプルです。
 * コメントでマニュアル説明してます。
 *
 * @group App   // app内のテストは必ず書く
 */
// クラス名は Test で始める
// Fuel\Core\TestCase を継承する
class Test_Sample extends Fuel\Core\TestCase
{
	/**
	 * テストケースクラスの最初のテストメソッドの実行前に実行されるメソッド
	 */
	public static function setUpBeforeClass()
	{
	}

	/**
	 * テストケースクラスの最後のテストメソッドの実行後に実行されるメソッド
	 */
	public static function tearDownAfterClass()
	{
	}

	/**
	 * 各テストメソッドの実行前に実行されるメソッド
	 */
	public function setUp()
	{
	}

	/**
	 * 各テストメソッドの実行後に実行されるメソッド
	 */
	public function tearDown()
	{
	}

	/** // 第一コメントはこの形で統一
	 * Tests Sample::append()
	 *
	 * // 補足説明などあれば書く
	 *
	 * // test アノテーションを書いておくと、メソッド名が test_ 始まりでなくていい
	 * @test
	 * // dataProvider アノテーションで引数リストを返すメソッド名を指定できる
	 * @dataProvider append_provider
	 */
	public function append($str, $append, $expected)
	{
		// テスト対象の処理を実行し、結果を得る
		$actual = Sample::append($str, $append);

		// assertEquals()は「==」での比較
		// assertSame()  は「===」での比較
		$this->assertSame($expected, $actual);
	}

	/**
	 * append テストのテストデータを返すメソッド。
	 * 中身の配列1つにつき1回テストが実行される。
	 * もしテストが失敗した場合はこのような表示で何のテストが失敗したかが出力される。
	 * 『Test_Sample::append with data set #0 (NULL, ', Mizuki', 'hello, Mizuki')』
	 */
	public function append_provider()
	{
		return array(
			array('hello', ', Mizuki', 'hello, Mizuki'),
			array('hello', '', 'hello'),
			array('hello', null, 'hello'),
			array('hello', 1, 'hello1'),
			array(1, 'hello', '1hello'),
		);
	}

	/**
	 * 例外が発生することをテストするサンプル
	 *
	 * @test
	 * // 発生する例外の型を書いておく
	 * // 他の型の例外だったり例外が発生しないとテスト失敗
	 * @expectedException InvalidArgumentException
	 */
	public function append_exception()
	{
		Sample::append(null, "hello");
	}

}

class Sample
{
	/**
	 * 2つの文字列を連結するメソッド
	 *
	 * @param string $str
	 * @param string $append
	 * @throws InvalidArgumentException
	 * @return string
	 */
	public static function append($str, $append)
	{
		if ($str === null) {
			throw new InvalidArgumentException('第一引数にnullは指定できません。');
		}

		return $str.$append;
	}
}