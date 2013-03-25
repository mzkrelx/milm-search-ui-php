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
		$this->assertArrayHasKey('ml_proposals', $actual);
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
		$this->assertArrayHasKey('proposer_name', $actual);
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

	/**
	 * Tests Model_Ml_Proposal::update()
	 * エラーが発生ことなく終了する
	 *
	 * @test
	 */
	public function update()
	{
		Model_Ml_Proposal::update(1, array(
			"proposer_name"  => "みるむ太郎",
			"proposer_email" => "example@sample.com",
			"ml_title"       => "MilmSearch開発するよ！ML",
			"status"        => "new",
			"archive_type"   => "Mailman",
			"archive_u_r_l"    => "http://aaa.com/arcieve.html",
			"comment"       => "よろしくお願いします！",
		));
	}

	/**
	 * Tests Model_Ml_Proposal::update()
	 * エラーが発生ことなく終了する
	 *
	 * @test
	 * @expectedException Fuel\Core\HttpServerErrorException
	 */
	public function update_exception()
	{
		// テストAPIではIDが101以上は例外発生
		Model_Ml_Proposal::update(1000, array(
			"proposer_name"  => "みるむ太郎",
			"proposer_email" => "example@sample.com",
			"ml_title"       => "MilmSearch開発するよ！ML",
			"status"        => "new",
			"archive_type"   => "Mailman",
			"archive_u_r_l"    => "http://aaa.com/arcieve.html",
			"comment"       => "よろしくお願いします！",
		));
	}

}