<?php
use Fuel\Core\HttpNotFoundException;

class Controller_Admin_Ml extends Controller_Template
{
	public $template = 'template_admin';

	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		return $this->action_list();
	}

	public function action_list()
	{
		$this->template->set_global('title', 'ML一覧 : Milm Search Admin');
		$this->template->content = View::forge('ml/list');
	}

	public function action_show($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}

		$this->template->set_global('title', 'ML詳細 : Milm Search Admin');

		$data = array(
			'id' => $id
		);
		$this->template->content = View::forge('ml/show', $data);
	}

	public function action_edit()
	{
		$this->template->set_global('title', 'ML詳細 : Milm Search Admin');
		$this->template->content = View::forge('ml/show');
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