<?php
use Model\Ml;

use Fuel\Core\HttpNotFoundException;

class Controller_Ml extends Controller_Template
{
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
		$this->template->set_global('title', 'ML一覧 : Milm Search');

		$mls = Model_Ml::find_list(array());

		$this->template->content = View::forge('ml/list', array('mls' => $mls['mls']));
	}

	public function action_show($id = null)
	{
		if ($id === null) {
			throw new HttpNotFoundException();
		}

		$this->template->set_global('title', 'ML詳細 : Milm Search');

		$ml = Model_Ml::find_by_id($id);

		$this->template->content = View::forge('ml/show', array('ml' => $ml));
	}

	public function after($response)
	{
		$response = parent::after($response);

		$this->template->set_global('base_url', Config::get('base_url'));

		return $response;
	}
}