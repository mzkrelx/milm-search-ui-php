<?php
/**
 * MilmSearch UI-PHP is a part of mailing list searching system,
 * user interface on the WEB.
 *
 * Copyright (C) 2013 MilmSearch Project.
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 3
 * of the License, or any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this program.
 * If not, see <http://www.gnu.org/licenses/>.
 *
 * You can contact MilmSearch Project at mailing list
 * milm-search-public@lists.sourceforge.jp.
 *
 * @package    Milm
 * @version    0.1
 * @author     MilmSearch Project
 * @license    GPLv3 or later License
 * @copyright  Copyright (C) 2013 MilmSearch Project
 */

/**
 * URLのトップ階層のコントローラ
 */
class Controller_Top extends Controller_Template
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