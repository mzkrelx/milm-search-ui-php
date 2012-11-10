<?php
use Milm\Api;

/**
 * APIのテスト用のコントローラ
 * ML登録申請リソースのアクセスURLは本当は ml-proposals だが、
 * mlproposals になっているのはメソッド名にハイフンが書けないのでここだけ。
 */
class Controller_Apitest extends Controller_Rest
{
	/**
	 * デフォルトのレスポンスのフォーマット
	 *
	 * @var string
	 */
	protected $format = 'json';

	/**
	 * ML登録申請作成
	 *
	 * POST : /apitest/mlproposals
	 */
	public function post_mlproposals()
	{
		$this->response(array('作成しました'), 201);
	}

	/**
	 * ML登録申請一覧、詳細の取得
	 *
	 * GET : /apitest/mlproposals
	 * GET : /apitest/mlproposals/{$id}
	 *
	 * パラメータ
	 *   ・status=ステータス
	 *   ・sort=ソート列名
	 *   ・order=昇順か逆順か
	 *   ・pp=1ページの項目数
	 *   ・page=ぺージ番号
	 */
	public function get_mlproposals($id = null)
	{
		if ($id !== null) {
			if ($id < 0 or $id > 200) {
				$this->response(array('error' => '無効な値:'.$id), 404);
				return;
			}
			$this->response(array(
				"proposerName" => "申請者の名前".$id,
				"proposerEmail" => "申請者のメールアドレス",
				"mlTitle" => "MLタイトル(ML名)",
				"status" => "new",
				"archiveType" => "メールアーカイブの種類(ex. mailman)",
				"archiveUrl" => "メールアーカイブの基底URL",
				"comment" => "コメント(MLの説明など)",
				"createdAt" => "2012-01-02T03:04:05+09:00",
				"updatedAt" => "2012-11-12T13:14:15+09:00",
			), 200);
			return;
		}

		$status = 'new';
		if (isset($_GET[Api::QUERY_FILTER_VALUE])) {
			$status = $_GET[Api::QUERY_FILTER_VALUE];
		}

		$count = 20;
		if (isset($_GET[Api::QUERY_COUNT])) {
		    $count = $_GET[Api::QUERY_COUNT];
		}

		$total_results = 24;
		$ml_proposals = array();
		$ml_proposals[Api::RESULT_TOTAL_RESULTS]  = $total_results;
		$ml_proposals[Api::RESULT_START_INDEX]    = 1;
		$ml_proposals[Api::RESULT_ITEMS_PER_PAGE] = $count;

		$ml_proposals['mlProposals'] = array();
		for ($i = 1; $i <= $count; $i++) {
			$ml_proposals['mlProposals'][] = array(
				"id" => $i,
				"proposerName" => "申請者の名前".$i,
				"proposerEmail" => "申請者のメールアドレス".$i,
				"mlTitle" => "MLタイトル(ML名)".$i,
				"status" => $status,
				"archiveType" => "メールアーカイブの種類(ex. mailman)",
				"archiveUrl" => "http://xxx",
				"comment" => "コメント(MLの説明など).$i",
				"createdAt" => "2012-01-02T03:04:05+09:00",
				"updatedAt" => "2012-11-12T13:14:15+09:00",
			);
		}
		$this->response($ml_proposals, 200);
	}

	/**
	 * ML登録申請更新
	 *
	 * PUT : /apitest/mlproposals/{$id}
	 */
	public function put_mlproposals($id = null)
	{
		if ($id === null) {
			$this->response(array('error' => '無効な値:'.$id), 404);
			return;
		}
		$this->response(array(), 200);
	}

	/**
	 * ML登録申請削除
	 *
	 * DELETE : /apitest/mlproposals/{$id}
	 */
	public function delete_mlproposals($id = null)
	{
		if ($id === null) {
			$this->response(array('error' => '無効な値:'.$id), 404);
			return;
		}
		$this->response(array(), 200);
	}

	/**
	 * ML一覧、詳細の取得
	 *
	 * GET : /apitest/mls
	 * GET : /apitest/mls/{$id}
	 *
	 * パラメータ
	 *   ・sort=ソート列名
	 *   ・order=昇順か逆順か
	 *   ・pp=1ページの項目数
	 *   ・page=ぺージ番号
	 */
	public function get_mls($id = null)
	{
		if ($id !== null) {
			if ($id < 0 or $id > 100) {
				$this->response(array('error' => '無効な値:'.$id), 404);
				return;
			}
			$this->response(array(
				"id" => $id,
				"proposerName" => "申請者の名前",
				"proposerEmail" => "申請者のメールアドレス",
				"mlTitle" => "MLタイトル(ML名)",
				"status" => "new",
				"archiveType" => "メールアーカイブの種類(ex. mailman)",
				"archiveUrl" => "メールアーカイブの基底URL",
				"comment" => "コメント(MLの説明など)"
			), 200);
			return;
		}
		$this->response(array(
			'mls' => array(
				array(
					"id" => 1,
					"proposerName" => "申請者の名前",
					"proposerEmail" => "申請者のメールアドレス",
					"mlTitle" => "MLタイトル(ML名)",
					"status" => "new",
					"archiveType" => "メールアーカイブの種類(ex. mailman)",
					"archiveUrl" => "メールアーカイブの基底URL",
					"comment" => "コメント(MLの説明など)"
				),
				array(
					"id" => 2,
					"proposerName" => "申請者の名前",
					"proposerEmail" => "申請者のメールアドレス",
					"mlTitle" => "MLタイトル(ML名)",
					"status" => "new",
					"archiveType" => "メールアーカイブの種類(ex. mailman)",
					"archiveUrl" => "メールアーカイブの基底URL",
					"comment" => "コメント(MLの説明など)"
				),
			),
		), 200);
	}

}