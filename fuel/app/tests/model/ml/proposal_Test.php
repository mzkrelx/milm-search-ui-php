<?php
/**
 * @group App
 */
class Test_Model_Ml_Proposal extends Fuel\Core\TestCase
{
	private $_configTmp;

	/**
	 * 各テストメソッドの実行前に実行されるメソッド
	 */
	public function setUp()
	{
		// テストメソッドでコンフィグをいじっても大丈夫なように、後で戻すためとっておく。
		$this->_configTmp = Config::get('_ml_proposals');
	}

	/**
	 * 各テストメソッドの実行後に実行されるメソッド
	 */
	public function tearDown()
	{
		Config::set('_ml_proposals', $this->_configTmp);
	}

	/**
	 * Tests Model_Ml_Proposal::find_list()
	 *
	 * @test
	 */
	public function find_list()
	{
		$actual = Model_Ml_Proposal::find_list(null);
		$this->assertArrayHasKey('ml-proposals', $actual);
	}

	/**
	 * Tests Model_Ml_Proposal::find_list()
	 *
	 * 存在しないURLにアクセスした場合例外が発生する
	 *
	 * @test
	 * @expectedException Fuel\Core\HttpServerErrorException
	 */
	public function find_list_exception()
	{
		Config::set('_ml_proposals', 'notfound');

		Model_Ml_Proposal::find_list(null);
	}

	/**
	 * Tests Model_Ml_Proposal::find_by_id()
	 *
	 * @test
	 * @dataProvider find_by_id_provider
	 */
	public function find_by_id($id)
	{
		$actual = Model_Ml_Proposal::find_by_id($id);
		$this->assertArrayHasKey('id', $actual);
	}

	/**
	 * find_by_id のテストデータ
	 *
	 * @return array
	 */
	public function find_by_id_provider()
	{
	    return array(
	        array(0),
	        array(1),
	    );
	}

	/**
	 * Tests Model_Ml_Proposal::find_by_id()
	 *
	 * @test
	 * @dataProvider find_by_id_invalid_id_provider
	 * @expectedException Fuel\Core\HttpServerErrorException
	 */
	public function find_by_id_invalid_id($id)
	{
		Model_Ml_Proposal::find_by_id($id);
	}

	/**
	 * find_by_id_invalid_id のテストデータ
	 *
	 * @return array
	 */
	public function find_by_id_invalid_id_provider()
	{
	    return array(
	        array(-1),
	        array(100000000000000),
	    );
	}

	/**
	 * Tests Model_Ml_Proposal::find_by_id()
	 *
	 * 存在しないURLにアクセスした場合例外が発生する
	 *
	 * @test
	 * @expectedException Fuel\Core\HttpServerErrorException
	 */
	public function find_by_id_exception()
	{
		Config::set('_ml_proposals', 'notfound');

		Model_Ml_Proposal::find_by_id(1);
	}

}