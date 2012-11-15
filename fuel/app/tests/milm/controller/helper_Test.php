<?php
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
			"proposerName"  => "みるむ太郎",
			"proposerEmail" => "example@sample.com",
			"mlTitle"       => "MilmSearch開発するよ！ML",
			"status"        => "new",
			"archiveType"   => "Mailman",
			"archiveUrl"    => "http://aaa.com/arcieve.html",
			"comment"       => "よろしくお願いします！",
			"createdAt"     => "2012-01-02T03:04:05+09:00",
			"updatedAt"     => "2012-11-12T13:14:15+09:00",
		);
		$actual = Controller_Helper::for_view_mlp($ml_proposal);

		$this->assertSame("みるむ太郎", $actual['proposerName']);
		$this->assertSame("example@sample.com", $actual['proposerEmail']);
		$this->assertSame("MilmSearch開発するよ！ML", $actual['mlTitle']);
		$this->assertSame("new", $actual['status']);
		$this->assertSame("Mailman", $actual['archiveType']);
		$this->assertSame("http://aaa.com/arcieve.html", $actual['archiveUrl']);
		$this->assertSame("よろしくお願いします！", $actual['comment']);
		$this->assertSame("2012/01/02", $actual['createdAt']);
		$this->assertSame("2012/11/12", $actual['updatedAt']);
	}

	/**
	 * ML登録申請情報をビュー用に変換するテスト
	 * 申請者名だけにする
	 */
	public function test_for_view_mlp_1col()
	{
		$ml_proposal = array(
			"proposerName"  => "みるむ太郎",
			"proposerEmail" => "example@sample.com",
			"mlTitle"       => "MilmSearch開発するよ！ML",
			"status"        => "new",
			"archiveType"   => "Mailman",
			"archiveUrl"    => "http://aaa.com/arcieve.html",
			"comment"       => "よろしくお願いします！",
			"createdAt"     => "2012-01-02T03:04:05+09:00",
			"updatedAt"     => "2012-11-12T13:14:15+09:00",
		);
		$actual = Controller_Helper::for_view_mlp($ml_proposal, array('proposerName'));

		$this->assertSame("みるむ太郎", $actual['proposerName']);
		$this->assertEquals(1, sizeof($actual));
	}

	/**
	 * ML登録申請情報の配列をビュー用に変換するテスト
	 */
	public function test_for_view_mlps()
	{
		$ml_proposals['mlProposals'] = array();
		for ($i = 1; $i <= 20; $i++) {
		    $ml_proposals['mlProposals'][] = array(
		        "id" => $i,
		        "proposerName" => "申請者の名前".$i,
		        "proposerEmail" => "申請者のメールアドレス".$i,
		        "mlTitle" => "MLタイトル(ML名)".$i,
		        "status" => "new",
		        "archiveType" => "メールアーカイブの種類(ex. mailman)",
		        "archiveUrl" => "http://xxx",
		        "comment" => "コメント(MLの説明など).$i",
		        "createdAt" => "2012-01-02T03:04:05+09:00",
		        "updatedAt" => "2012-11-12T13:14:15+09:00",
		    );
		}

		$actual = Controller_Helper::for_view_mlps($ml_proposals['mlProposals']);
		$this->assertSame("2012/01/02", $actual[0]['createdAt']);
		$this->assertEquals(20, sizeof($actual));
		$this->assertEquals(3, sizeof($actual[0]));
	}

	/**
	 * ML登録申請情報の配列をビュー用に変換するテスト
	 * MLタイトルだけにする
	 */
	public function test_for_view_mlps_1col()
	{
		$ml_proposals['mlProposals'] = array();
		for ($i = 1; $i <= 20; $i++) {
		    $ml_proposals['mlProposals'][] = array(
		        "id" => $i,
		        "proposerName" => "申請者の名前".$i,
		        "proposerEmail" => "申請者のメールアドレス".$i,
		        "mlTitle" => "MLタイトル(ML名)".$i,
		        "status" => "new",
		        "archiveType" => "メールアーカイブの種類(ex. mailman)",
		        "archiveUrl" => "http://xxx",
		        "comment" => "コメント(MLの説明など).$i",
		        "createdAt" => "2012-01-02T03:04:05+09:00",
		        "updatedAt" => "2012-11-12T13:14:15+09:00",
		    );
		}

		$actual = Controller_Helper::for_view_mlps($ml_proposals['mlProposals'], array('mlTitle'));
		$this->assertSame("MLタイトル(ML名)1", $actual[0]['mlTitle']);
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