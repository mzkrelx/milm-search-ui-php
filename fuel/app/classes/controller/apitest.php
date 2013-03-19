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
			$status = 'new';
			if ($id > 10) {
				$status = 'accepted';
			}
			if ($id > 20) {
				$status = 'rejected';
			}
			$this->response(array(
				"proposerName" => "みるむ太郎".$id,
				"proposerEmail" => "example@sample.com",
				"mlTitle" => "MilmSearch開発するよ！ML".$id,
				"status" => $status,
				"archiveType" => "mailman",
				"archiveURL" => "http://aaa.com/arcieve.html",
				"comment" => "よろしくお願いします！",
				"createdAt" => "2012-01-02T03:04:05+09:00",
				"updatedAt" => "2012-11-12T13:14:15+09:00",
			), 200);
			return;
		}

		$status = array_get_or($_GET, Config::get('_query.filter_value'), 'new');
		$count = array_get_or($_GET, Config::get('_query.count'), 20);
		$page = array_get_or($_GET, Config::get('_query.start_page'), 1);

		$startIndex = 1;
		if ($page > 1) {
			$startIndex = ($page - 1) * $count;
		}

		$total_results = 24;
		$ml_proposals = array();
		$ml_proposals[Config::get('_result_key.total_results')]  = $total_results;
		$ml_proposals[Config::get('_result_key.start_index')]    = $startIndex;
		$ml_proposals[Config::get('_result_key.items_per_page')] = $count;

		$stop_count = $count;
		if (($total_results - $startIndex) < $count) {
			$stop_count = $total_results - $startIndex;
		}

		$ml_proposals['items'] = array();
		for ($i = 1; $i <= $stop_count; $i++) {
			$ml_proposals['items'][] = array(
				"id" => $i,
				"proposerName" => "申請者の名前".$i,
				"proposerEmail" => "申請者のメールアドレス".$i,
				"mlTitle" => "MLタイトル(ML名)".$i,
				"status" => $status,
				"archiveType" => "メールアーカイブの種類(ex. mailman)",
				"archiveURL" => "http://xxx",
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
		if ($id === null or $id > 100) {
			$this->response(array('error' => '無効な値:'.$id), 404);
			return;
		}
		$this->response(array(), 204);
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
				"archiveURL" => "メールアーカイブの基底URL",
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
					"archiveURL" => "メールアーカイブの基底URL",
					"comment" => "コメント(MLの説明など)"
				),
				array(
					"id" => 2,
					"proposerName" => "申請者の名前",
					"proposerEmail" => "申請者のメールアドレス",
					"mlTitle" => "MLタイトル(ML名)",
					"status" => "new",
					"archiveType" => "メールアーカイブの種類(ex. mailman)",
					"archiveURL" => "メールアーカイブの基底URL",
					"comment" => "コメント(MLの説明など)"
				),
			),
		), 200);
	}

}