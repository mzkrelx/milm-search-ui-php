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
		$this->template->set_global('title', 'ML登録申請一覧 : Milm Search Admin');

		$proposals = Model_Ml_Proposal::find_list(array());

		$this->template->content = View::forge(
			'admin/ml/proposal/list',
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

		$this->template->set_global('title', 'ML登録申請詳細 : Milm Search Admin');

		$proposal = Model_Ml_Proposal::find_by_id($id);

		$this->template->content = View::forge(
			'admin/ml/proposal/show',
			array('proposal' => $proposal)
		);
	}

	/**
	 *
	 * @todo
	 * @return void
	 */
	public function action_edit()
	{
		$this->template->set_global('title', 'ML登録申請詳細 : Milm Search Admin');
		$this->template->content = View::forge('ml/show');
	}

	/**
	 * (non-PHPdoc)
	 * @see \Fuel\Core\Controller_Template::after()
	 */
	public function after($response)
	{
		$response = parent::after($response);

		$this->template->set_global('basePath', Config::get('base_url'));

		return $response;
	}
}