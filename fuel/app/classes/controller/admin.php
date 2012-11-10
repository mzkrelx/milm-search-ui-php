<?php
use Milm\Api;

use Fuel\Core\HttpNotFoundException;

require_once 'Zend/Date.php';

/**
 * 管理側のトップのコントローラです。
 */
class Controller_Admin extends Controller_Template
{
	/**
	 * テンプレートファイルの名前
	 *
	 * @var string
	 */
	public $template = 'template_admin';

	/**
	 * (non-PHPdoc)
	 * @see \Fuel\Core\Controller_Template::before()
	 */
	public function before()
	{
		parent::before();
	}

	/**
	 * URLのアクション名が省略されたときのアクション
	 * 管理側トップページ、登録状況など
	 *
	 * @return void
	 */
	public function action_index()
	{
		$display_count = 10;

		$newMlProposals = Model_Ml_Proposal::find_list(array(
			Api::QUERY_FILTER_BY    => Model_Ml_Proposal::FILTER_BY_STATUS,
			Api::QUERY_FILTER_VALUE => Model_Ml_Proposal::STATUS_NEW,
			Api::QUERY_SORT_BY      => Model_Ml_Proposal::SORT_BY_CREATED_AT,
			Api::QUERY_SORT_ORDER   => Api::SORT_ORDER_DESC,
			Api::QUERY_START_PAGE   => 1,
			Api::QUERY_COUNT        => $display_count
		));

		// 承認済みと却下済みはML申請情報の配列はいらないので、ソートとページの指定はデフォルトでOK
		$acceptedMlProposals = Model_Ml_Proposal::find_list(array(
		    Api::QUERY_FILTER_BY    => Model_Ml_Proposal::FILTER_BY_STATUS,
		    Api::QUERY_FILTER_VALUE => Model_Ml_Proposal::STATUS_ACCEPTED,
		));

		$rejectedMlProposals = Model_Ml_Proposal::find_list(array(
		    Api::QUERY_FILTER_BY    => Model_Ml_Proposal::FILTER_BY_STATUS,
		    Api::QUERY_FILTER_VALUE => Model_Ml_Proposal::STATUS_REJECTED,
		));

		$this->template->content = View::forge(
			'admin/index',
			array(
				'new_count'        => number_format($newMlProposals[Api::RESULT_TOTAL_RESULTS]),
				'accepted_count'   => number_format($acceptedMlProposals[Api::RESULT_TOTAL_RESULTS]),
				'rejected_count'   => number_format($rejectedMlProposals[Api::RESULT_TOTAL_RESULTS]),
				'new_ml_proposals' => $this->for_index_view($newMlProposals['mlProposals']),
				'is_more'          => ($newMlProposals[Api::RESULT_TOTAL_RESULTS] > 10),
			)
		);
	}

	/**
	 * ML登録申請情報の配列をビュー用に変換します。
	 *
	 * @param array $ml_proposals
	 * @return multitype:multitype:unknown Ambigous <string, unknown>
	 */
	private function for_index_view($ml_proposals)
	{
		$for_view_ml_proposals = array();
		foreach ($ml_proposals as $ml_proposal) {
			$created_at = new Zend_Date($ml_proposal['createdAt'], Zend_Date::ISO_8601);
			$for_view_ml_proposals[] = array(
				'id'        => $ml_proposal['id'],
				'createdAt' => $created_at->toString('y/MM/dd'),
				'mlTitle'   => $ml_proposal['mlTitle'],
			);
		}
		return $for_view_ml_proposals;
	}

	/**
	 * (non-PHPdoc)
	 * @see \Fuel\Core\Controller_Template::after()
	 */
	public function after($response)
	{
		$response = parent::after($response);

		$this->template->set_global('base_url', Config::get('base_url'));

		return $response;
	}
}