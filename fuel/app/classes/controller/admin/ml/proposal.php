<?php
use Milm\Api;
use Milm\Controller_Helper as Helper;

use Fuel\Core\HttpNotFoundException;

/**
 * 管理側のML登録申請のコントローラです。
 */
class Controller_Admin_Ml_Proposal extends Controller_Template
{
	const DEFAULT_LIST_COUNT = 20;

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
	 *
	 * @return void
	 */
	public function action_index()
	{
		return $this->action_list();
	}

	/**
	 * ML登録申請の一覧画面を表示するアクション
	 *
	 * @return void
	 */
	public function action_list($status = 'new', $page = 1)
	{
		switch ($status) {
			case Model_Ml_Proposal::STATUS_NEW:
			case Model_Ml_Proposal::STATUS_ACCEPTED:
			case Model_Ml_Proposal::STATUS_REJECTED:
				// OK, do nothing
				break;
			default:
				throw new HttpNotFoundException();
		}

		if (!is_numeric($page)) {
			throw new HttpNotFoundException();
		}

		$proposals = Model_Ml_Proposal::find_list(array(
			Api::QUERY_FILTER_BY    => Model_Ml_Proposal::FILTER_BY_STATUS,
			Api::QUERY_FILTER_VALUE => $status,
			Api::QUERY_SORT_BY      => Model_Ml_Proposal::SORT_BY_CREATED_AT,
			Api::QUERY_SORT_ORDER   => Api::SORT_ORDER_DESC,
			Api::QUERY_START_PAGE   => $page,
			Api::QUERY_COUNT        => self::DEFAULT_LIST_COUNT
		));

		Pagination::set_config(array(
			'pagination_url' => 'admin/ml/proposal/list/'.$status,
			'total_items'    => $proposals[Api::RESULT_TOTAL_RESULTS],
			'uri_segment'    => 6
		));

		$this->template->set_global('nav_status', $status);
		$this->template->content = View::forge(
			'admin/ml/proposal/list_'.$status,
			array(
				// TODO 承認済みと却下済みで承認日/却下日ができるようになったら、for_view_mlps の第2引数に表示項目追加
				'ml_proposals' => Helper::for_view_mlps($proposals['mlProposals']),
				'per_page'     => Pagination::$per_page > sizeof($proposals['mlProposals']) ?
				sizeof($proposals['mlProposals']) : Pagination::$per_page,
				'total_items'  => $proposals[Api::RESULT_TOTAL_RESULTS],
			)
		);
	}

	/**
	 * ML登録申請の詳細画面を表示するアクション
	 *
	 * @param  int $id
	 * @throws HttpNotFoundException
	 * @return void
	 */
	public function action_show($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}

		$proposal = Model_Ml_Proposal::find_by_id($id);

		if ($proposal == null) {
			throw new HttpNotFoundException();
		}

		$status = $proposal['status'];
		$this->template->set_global('nav_status', $status);
		$this->template->content = View::forge(
			'admin/ml/proposal/show_'.$status,
			array(
				'proposal_id' => $id,
				'proposal'    => Helper::for_view_mlp($proposal),
			)
		);
	}

	/**
	 * ML登録申請情報の編集画面を表示するアクション
	 *
	 * @return void
	 */
	public function action_edit($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}

		$proposal = Model_Ml_Proposal::find_by_id($id);

		if ($proposal == null) {
			throw new HttpNotFoundException();
		}

		$this->template->set_global('nav_status', $proposal['status']);

		if (Helper::is_post()) {
			$proposal['mlTitle']     = Helper::get_param('ml_title', '');
			$proposal['archiveType'] = Helper::get_param('archive_type', '');
			$proposal['archiveUrl']  = Helper::get_param('archive_url', '');

			Model_Ml_Proposal::update($id, $this->to_update_proposal($proposal));

			return Response::redirect('admin/ml/proposal/show/'.$id);
		}

		// when GET
		$this->template->content = View::forge(
			'admin/ml/proposal/edit',
			array(
				'proposal_id' => $id,
				'proposal'    => Helper::for_view_mlp($proposal),
				'archive_type_options' => array(
					Model_Ml_Proposal::ARCHIVE_TYPE_MAILMAN => 'Mailman',
					Model_Ml_Proposal::ARCHIVE_TYPE_OTHER   => 'その他',
				)
			)
		);
	}

	/**
	 * 承認確認画面を表示するアクション
	 *
	 * @return void
	 */
	public function action_accept_confirm($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}
		$proposal = Model_Ml_Proposal::find_by_id($id);

		$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
		$this->template->content = View::forge(
			'admin/ml/proposal/accept_confirm',
			array(
				'proposal_id' => $id,
				'proposal'    => Helper::for_view_mlp($proposal),
			)
		);
	}

	/**
	 * 承認完了画面を表示するアクション
	 *
	 * @return void
	 */
	public function action_accept()
	{
		$id = Helper::get_param('id', null);
		if ($id === null) {
			throw new HttpNotFoundException();
		}
		if (!Helper::is_post()) {
			return Response::redirect('admin/ml/proposal/accept_confirm/'.$id);
		}

		$proposal = Model_Ml_Proposal::find_by_id($id);
		$proposal['status'] = Model_Ml_Proposal::STATUS_ACCEPTED;
		Model_Ml_Proposal::update($id, $this->to_update_proposal($proposal));

		$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
		$this->template->content = View::forge(
			'admin/ml/proposal/accept_complete',
			array(
				'proposal_id' => $id,
				'proposal'    => Helper::for_view_mlp($proposal),
			)
		);
	}

	/**
	 * ML登録申請情報をUPDATE用の配列に変換します。
	 *
	 * @param  array $proposal
	 * @return array
	 */
	public function to_update_proposal($proposal)
	{
		if (isset($proposal['id'])) {
			unset($proposal['id']);
		}
		if (isset($proposal['createdAt'])) {
			unset($proposal['createdAt']);
		}
		if (isset($proposal['updatedAt'])) {
			unset($proposal['updatedAt']);
		}
		return $proposal;
	}

	/**
	 * 却下確認画面を表示するアクション
	 *
	 * @return void
	 */
	public function action_reject_confirm($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}
		$proposal = Model_Ml_Proposal::find_by_id($id);

		$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
		$this->template->content = View::forge(
			'admin/ml/proposal/reject_confirm',
			array(
				'proposal_id' => $id,
				'proposal'    => Helper::for_view_mlp($proposal),
			)
		);
	}

	/**
	 * 却下完了画面を表示するアクション
	 *
	 * @return void
	 */
	public function action_reject()
	{
		$id = Helper::get_param('id', null);
		if ($id === null) {
		    throw new HttpNotFoundException();
		}
		if (!Helper::is_post()) {
		    return Response::redirect('admin/ml/proposal/reject_confirm/'.$id);
		}

		$proposal = Model_Ml_Proposal::find_by_id($id);
		$proposal['status'] = Model_Ml_Proposal::STATUS_REJECTED;
		Model_Ml_Proposal::update($id, $this->to_update_proposal($proposal));

		$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
		$this->template->content = View::forge(
			'admin/ml/proposal/reject_complete',
			array(
				'proposal_id' => $id,
				'proposal'    => Helper::for_view_mlp($proposal),
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