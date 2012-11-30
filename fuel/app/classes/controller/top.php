<?php
/**
 * URLのトップ階層のコントローラ
 */
class Controller_Top extends Controller_Template
{
	public function before()
	{
		parent::before();
	}

	/**
	 * トップ
	 */
	public function action_index()
	{
		$this->template->content = View::forge('top/index');
	}

	/**
	 * ヘルプ
	 */
	public function action_help()
	{
		$this->template->content = View::forge('top/help');
	}

	/**
	 * お問い合わせ
	 */
	public function action_inquiry()
	{
		$this->template->content = View::forge('top/inquiry');
	}

	/**
	 * プライバシーポリシー
	 */
	public function action_poricy()
	{
		$this->template->content = View::forge('top/poricy');
	}

	/**
	 * 利用規約
	 */
	public function action_rules()
	{
		$this->template->content = View::forge('top/rules');
	}

	public function after($response)
	{
		$response = parent::after($response);

		$this->template->set_global('base_url', Config::get('base_url'));

		return $response;
	}
}