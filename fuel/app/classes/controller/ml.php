<?php
use Model\Ml;

use Fuel\Core\HttpNotFoundException;

/**
 * 一般側のMLコントローラ
 */
class Controller_Ml extends Controller_Template
{

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
	 * ML一覧を表示します。
	 *
	 * @return void
	 */
	public function action_index()
	{
		return $this->action_list();
	}

	/**
	 * ML一覧を表示するアクション
	 *
	 * @return void
	 */
	public function action_list()
	{
		$this->template->set_global('title', 'ML一覧 : Milm Search');

		$mls = Model_Ml::find_list(array());

		$this->template->content = View::forge('ml/list', array('mls' => $mls['mls']));
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