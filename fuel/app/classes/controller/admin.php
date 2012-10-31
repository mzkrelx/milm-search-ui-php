<?php
use Fuel\Core\HttpNotFoundException;

/**
 * 管理側のトップのコントローラです。
 */
class Controller_Admin extends Controller_Template
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
	 * 管理側トップページ、登録状況など
	 *
	 * @return void
	 */
	public function action_index()
	{
		$this->template->content = View::forge(
			'admin/index'
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