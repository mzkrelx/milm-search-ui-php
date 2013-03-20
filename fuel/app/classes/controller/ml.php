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
use Model\Ml;
use Milm\Controller_Helper as Helper;

use Fuel\Core\HttpNotFoundException;

/**
 * 一般側のMLコントローラ
 */
class Controller_Ml extends Controller_Template
{
	/** リストの1ページの表示数 */
	const DEFAULT_LIST_COUNT = 10;

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
	public function action_list($page = 1)
	{
		if (!is_numeric($page)) {
			throw new HttpNotFoundException();
		}

		$this->template->set_global('title', 'ML一覧 : Milm Search');

		$results = Model_Ml::find_list(array(
			Config::get('_query.start_page')   => $page,
			Config::get('_query.count')        => self::DEFAULT_LIST_COUNT)
		);

		Pagination::set_config(array(
			'pagination_url' => 'ml/list',
			'total_items'    => $results[Config::get('_result_key.total_results')],
			'uri_segment'    => 3,
			'per_page'       => self::DEFAULT_LIST_COUNT,
			'current_page'   => $page,
		));

		$this->template->content = View::forge('ml/list',
			array(
				'mls' => Helper::for_view_mls($results[Config::get('_result_key.items')]),
				'per_page'     => sizeof($results[Config::get('_result_key.items')]),
				'total_items'  => $results[Config::get('_result_key.total_results')],
			)
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