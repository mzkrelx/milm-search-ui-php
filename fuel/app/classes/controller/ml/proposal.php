<?php
/**
 * ユーザ側のML登録申請のコントローラ
 */
class Controller_Ml_Proposal extends Controller_Template
{
	public function before()
	{
		parent::before();
	}

	/**
	 * URLのアクション名省略時のアクション
	 */
	public function action_index()
	{
		return $this->action_attention();
	}

	/**
	 * ML登録申請の入力画面を表示するアクション
	 */
	public function action_input()
	{
		$this->template->set_global('title', '登録申請 : Milm Search');
		$this->template->content = View::forge('ml/proposal/input');
	}

	/**
	 * ML登録申請の確認画面を表示するアクション
	 */
	public function action_confirm()
	{
		$this->template->set_global('title', '登録申請の確認 : Milm Search');
		$this->template->content = View::forge('ml/proposal/confirm');
	}

	/**
	 * ML登録申請の完了画面を表示するアクション
	 */
	public function action_complete()
	{
		$this->template->set_global('title', '登録申請完了 : Milm Search');
		$this->template->content = View::forge('ml/proposal/complete');
	}

	public function after($response)
	{
		$response = parent::after($response);

		$this->template->set_global('base_url', Config::get('base_url'));

		return $response;
	}
}