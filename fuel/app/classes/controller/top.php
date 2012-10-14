<?php

class Controller_Top extends Controller_Template
{
	public function before()
	{
		parent::before();
	}

	public function action_index()
	{
		$this->template->set_global('title', 'トップ : Milm Search');
		$this->template->content = View::forge('top/index');
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