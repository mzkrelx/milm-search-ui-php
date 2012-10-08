<?php
class Controller_Ml_Proposal extends Controller_Template
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		return $this->action_attention();
	}

	public function action_attention()
	{
		$this->template->set_global('title', '規約・手順 : Milm Search');
		$this->template->content = View::forge('ml/proposal/attention');
	}

	public function action_form()
	{
		$this->template->set_global('title', '登録申請 : Milm Search');
		$this->template->content = View::forge('ml/proposal/form');
	}

	public function action_confirm()
	{
		$this->template->set_global('title', '登録申請の確認 : Milm Search');
		$this->template->content = View::forge('ml/proposal/confirm');
	}

	public function action_add()
	{
		$this->template->set_global('title', '登録申請完了 : Milm Search');
		$this->template->content = View::forge('ml/proposal/add');
	}

	public function after($response)
	{
		$response = parent::after($response);

		require_once 'Zend/Controller/Request/Http.php';
		$http = new Zend_Controller_Request_Http();
		$this->template->set_global('basePath', $http->getBasePath());

		return $response;
	}
}