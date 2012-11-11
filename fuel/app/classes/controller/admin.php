<?php
use Milm\Api;
use Milm\Controller_Helper as Helper;

use Fuel\Core\HttpNotFoundException;

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
				'new_ml_proposals' => Helper::for_view_mlps($newMlProposals['mlProposals']),
				'is_more'          => ($newMlProposals[Api::RESULT_TOTAL_RESULTS] > 10),
			)
		);
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