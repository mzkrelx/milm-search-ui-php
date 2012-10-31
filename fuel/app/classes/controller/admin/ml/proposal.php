<?php
use Fuel\Core\HttpNotFoundException;

/**
 * 管理側のML登録申請のコントローラです。
 */
class Controller_Admin_Ml_Proposal extends Controller_Template
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
	public function action_list()
	{
		$status = Model_Ml_Proposal::STATUS_NEW;	// default
		if (isset($_GET['status'])) {
			$status = $_GET['status'];
		}
		// TODO status のバリデーション

		$proposals = Model_Ml_Proposal::find_list(array());	// TODO 引数に取得条件渡す
		$this->template->set_global('nav_status', $status);
		$this->template->content = View::forge(
			'admin/ml/proposal/list_'.$status,
			array('proposals' => $proposals['ml-proposals'])
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

		// TODO status によってビュー切り替え。今だけサンプルでid指定
		if ($id < 10) {
			$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
			$this->template->content = View::forge(
				'admin/ml/proposal/show_new',
				array('proposal' => $proposal)
			);
			return;
		}

		if ($id < 20) {
			$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_ACCEPTED);
			$this->template->content = View::forge(
				'admin/ml/proposal/show_accepted',
				array('proposal' => $proposal)
			);
			return;
		}

		if ($id < 30) {
			$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_REJECTED);
			$this->template->content = View::forge(
				'admin/ml/proposal/show_rejected',
				array('proposal' => $proposal)
			);
			return;
		}

		$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
		$this->template->content = View::forge(
			'admin/ml/proposal/show_new',
			array('proposal' => $proposal)
		);

	}

	/**
	 *
	 * @todo GET は編集画面、POSTは変更処理
	 * @return void
	 */
	public function action_edit($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}
		$proposal = Model_Ml_Proposal::find_by_id($id);

		$this->template->set_global('nav_status', '');	//TODO $proposalのステータスによって変える
		$this->template->content = View::forge(
			'admin/ml/proposal/edit',
			array('proposal' => $proposal)
		);
	}

	/**
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
			array('proposal' => $proposal)
		);
	}

	/**
	 *
	 * @return void
	 */
	public function action_accept($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}
		$proposal = Model_Ml_Proposal::find_by_id($id);

		$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
		$this->template->content = View::forge(
			'admin/ml/proposal/accept_complete',
			array('proposal' => $proposal)
		);
	}

	/**
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
			array('proposal' => $proposal)
		);
	}

	/**
	 *
	 * @return void
	 */
	public function action_reject($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}
		$proposal = Model_Ml_Proposal::find_by_id($id);

		$this->template->set_global('nav_status', Model_Ml_Proposal::STATUS_NEW);
		$this->template->content = View::forge(
			'admin/ml/proposal/reject_complete',
			array('proposal' => $proposal)
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