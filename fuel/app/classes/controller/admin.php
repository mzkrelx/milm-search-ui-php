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
			Config::get('_query.filter_by')    => Config::get('_mlp.filter_by.status'),
			Config::get('_query.filter_value') => Config::get('_mlp.status.new'),
			Config::get('_query.sort_by')      => Config::get('_mlp.sort_by.created_at'),
			Config::get('_query.sort_order')   => Config::get('_sort_order.desc'),
			Config::get('_query.start_page')   => 1,
			Config::get('_query.count')        => $display_count,
		));

		// 承認済みと却下済みはML申請情報の配列はいらないので、ソートとページの指定はデフォルトでOK
		$acceptedMlProposals = Model_Ml_Proposal::find_list(array(
			Config::get('_query.filter_by')    => Config::get('_mlp.filter_by.status'),
			Config::get('_query.filter_value') => Config::get('_mlp.status.accepted'),
		));

		$rejectedMlProposals = Model_Ml_Proposal::find_list(array(
			Config::get('_query.filter_by')    => Config::get('_mlp.filter_by.status'),
			Config::get('_query.filter_value') => Config::get('_mlp.status.rejected'),
		));

		$this->template->content = View::forge(
			'admin/index',
			array(
				'new_count'        => number_format($newMlProposals[Config::get('_result_key.total_results')]),
				'accepted_count'   => number_format($acceptedMlProposals[Config::get('_result_key.total_results')]),
				'rejected_count'   => number_format($rejectedMlProposals[Config::get('_result_key.total_results')]),
				'new_ml_proposals' => Helper::for_view_mlps($newMlProposals[Config::get('_result_key.ml_proposals')]),
				'is_more'          => ($newMlProposals[Config::get('_result_key.total_results')] > 10),
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