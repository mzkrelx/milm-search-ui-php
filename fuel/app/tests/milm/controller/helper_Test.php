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
use Milm\Controller_Helper;

/**
 * @group App
 */
class Test_Controller_Helper extends Fuel\Core\TestCase
{
	private $get_tmp;
	private $post_tmp;

	/**
	 * 各テストメソッドの実行前に実行されるメソッド
	 */
	public function setUp()
	{
		$this->get_tmp  = $_GET;
		$this->post_tmp = $_POST;
	}

	/**
	 * 各テストメソッドの実行後に実行されるメソッド
	 */
	public function tearDown()
	{
		$_GET  = $this->get_tmp;
		$_POST = $this->post_tmp;
	}

	/**
	 * GET のパラメータを取得するテスト
	 */
	public function test_get_param_get()
	{
		$paramName = 'param1';
		$_GET[$paramName] = 'PARAM-1';

		$actual = Controller_Helper::get_param($paramName);
		$this->assertSame('PARAM-1', $actual);
	}

	/**
	 * GET も POST も null の場合にデフォルト値になるかのテスト
	 */
	public function test_get_param_null_default()
	{
		$paramName = 'param1';
		$_GET[$paramName] = null;
		$_POST[$paramName] = null;

		$actual = Controller_Helper::get_param($paramName, 'default');
		$this->assertSame('default', $actual);
	}

	/**
	 * GET も POST も空文字の場合にデフォルト値になるかのテスト
	 */
	public function test_get_param_empty_default()
	{
		$paramName = 'param1';
		$_GET[$paramName] = '';
		$_POST[$paramName] = '';

		$actual = Controller_Helper::get_param($paramName, 'default');
		$this->assertSame('default', $actual);
	}

	/**
	 * GET も POST もパラメータがない場合にデフォルト値になるかのテスト
	 */
	public function test_get_param_none_default()
	{
		$paramName = 'param1';
		unset($_GET[$paramName]);
		unset($_POST[$paramName]);

		$actual = Controller_Helper::get_param($paramName, 'default');
		$this->assertSame('default', $actual);
	}

	/**
	 * POST のパラメータを取得するテスト
	 */
	public function test_get_param_post()
	{
		$paramName = 'param1';
		$_POST[$paramName] = 'PARAM-1';

		$actual = Controller_Helper::get_param($paramName);
		$this->assertSame('PARAM-1', $actual);
	}

	/**
	 * ML登録申請情報をビュー用に変換するテスト
	 */
	public function test_for_view_mlp()
	{
		$ml_proposal = array(
			"proposer_name"  => "みるむ太郎",
			"proposer_email" => "example@sample.com",
			"ml_title"       => "MilmSearch開発するよ！ML",
			"status"        => "new",
			"archive_type"   => "Mailman",
			"archive_url"    => "http://aaa.com/arcieve.html",
			"comment"       => "よろしくお願いします！",
			"created_at"     => "2012-01-02T03:04:05+09:00",
			"updated_at"     => "2012-11-12T13:14:15+09:00",
		);
		$actual = Controller_Helper::for_view_mlp($ml_proposal);

		$this->assertSame("みるむ太郎", $actual['proposer_name']);
		$this->assertSame("example@sample.com", $actual['proposer_email']);
		$this->assertSame("MilmSearch開発するよ！ML", $actual['ml_title']);
		$this->assertSame("new", $actual['status']);
		$this->assertSame("Mailman", $actual['archive_type']);
		$this->assertSame("http://aaa.com/arcieve.html", $actual['archive_url']);
		$this->assertSame("よろしくお願いします！", $actual['comment']);
		$this->assertSame("2012/01/02", $actual['created_at']);
		$this->assertSame("2012/11/12", $actual['updated_at']);
	}

	/**
	 * ML登録申請情報をビュー用に変換するテスト
	 * 申請者名だけにする
	 */
	public function test_for_view_mlp_1col()
	{
		$ml_proposal = array(
			"proposer_name"  => "みるむ太郎",
			"proposer_email" => "example@sample.com",
			"ml_title"       => "MilmSearch開発するよ！ML",
			"status"        => "new",
			"archive_type"   => "Mailman",
			"archive_url"    => "http://aaa.com/arcieve.html",
			"comment"       => "よろしくお願いします！",
			"created_at"     => "2012-01-02T03:04:05+09:00",
			"updated_at"     => "2012-11-12T13:14:15+09:00",
		);
		$actual = Controller_Helper::for_view_mlp($ml_proposal, array('proposer_name'));

		$this->assertSame("みるむ太郎", $actual['proposer_name']);
		$this->assertEquals(1, sizeof($actual));
	}

	/**
	 * ML登録申請情報の配列をビュー用に変換するテスト
	 */
	public function test_for_view_mlps()
	{
		$ml_proposals['ml_proposals'] = array();
		for ($i = 1; $i <= 20; $i++) {
		    $ml_proposals['ml_proposals'][] = array(
		        "id" => $i,
		        "proposer_name" => "申請者の名前".$i,
		        "proposer_email" => "申請者のメールアドレス".$i,
		        "ml_title" => "MLタイトル(ML名)".$i,
		        "status" => "new",
		        "archive_type" => "メールアーカイブの種類(ex. mailman)",
		        "archive_url" => "http://xxx",
		        "comment" => "コメント(MLの説明など).$i",
		        "created_at" => "2012-01-02T03:04:05+09:00",
		        "updated_at" => "2012-11-12T13:14:15+09:00",
		    );
		}

		$actual = Controller_Helper::for_view_mlps($ml_proposals['ml_proposals']);
		$this->assertSame("2012/01/02", $actual[0]['created_at']);
		$this->assertEquals(20, sizeof($actual));
		$this->assertEquals(3, sizeof($actual[0]));
	}

	/**
	 * ML登録申請情報の配列をビュー用に変換するテスト
	 * MLタイトルだけにする
	 */
	public function test_for_view_mlps_1col()
	{
		$ml_proposals['ml_proposals'] = array();
		for ($i = 1; $i <= 20; $i++) {
		    $ml_proposals['ml_proposals'][] = array(
		        "id" => $i,
		        "proposer_name" => "申請者の名前".$i,
		        "proposer_email" => "申請者のメールアドレス".$i,
		        "ml_title" => "MLタイトル(ML名)".$i,
		        "status" => "new",
		        "archive_type" => "メールアーカイブの種類(ex. mailman)",
		        "archive_url" => "http://xxx",
		        "comment" => "コメント(MLの説明など).$i",
		        "created_at" => "2012-01-02T03:04:05+09:00",
		        "updated_at" => "2012-11-12T13:14:15+09:00",
		    );
		}

		$actual = Controller_Helper::for_view_mlps($ml_proposals['ml_proposals'], array('ml_title'));
		$this->assertSame("MLタイトル(ML名)1", $actual[0]['ml_title']);
		$this->assertEquals(20, sizeof($actual));
		$this->assertEquals(1, sizeof($actual[0]));
	}

	/**
	 * POST のときに POST メソッドのアクセスかどうか判断するテスト
	 */
	public function test_is_post_when_post()
	{
		$_SERVER['REQUEST_METHOD'] = 'POST';

		$this->assertTrue(Controller_Helper::is_post());
	}

	/**
	 * GET のときに POST メソッドのアクセスかどうか判断するテスト
	 */
	public function test_is_post_when_get()
	{
		$_SERVER['REQUEST_METHOD'] = 'GET';

		$this->assertFalse(Controller_Helper::is_post());
	}

}