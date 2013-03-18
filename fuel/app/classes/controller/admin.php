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
use Milm\Api;
use Milm\Controller_Helper as Helper;

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
		$display_count = 10;

		$new_ml_proposals = Model_Ml_Proposal::find_list(array(
			Config::get('_query.filter_by')    => Config::get('_mlp.filter_by.status'),
			Config::get('_query.filter_value') => Config::get('_mlp.status.new'),
			Config::get('_query.sort_by')      => Config::get('_mlp.sort_by.created_at'),
			Config::get('_query.sort_order')   => Config::get('_sort_order.desc'),
			Config::get('_query.start_page')   => 1,
			Config::get('_query.count')        => $display_count,
		));

		// 承認済みと却下済みはML申請情報の配列はいらないので、ソートとページの指定はデフォルトでOK
		$accepted_ml_proposals = Model_Ml_Proposal::find_list(array(
			Config::get('_query.filter_by')    => Config::get('_mlp.filter_by.status'),
			Config::get('_query.filter_value') => Config::get('_mlp.status.accepted'),
		));

		$rejected_ml_proposals = Model_Ml_Proposal::find_list(array(
			Config::get('_query.filter_by')    => Config::get('_mlp.filter_by.status'),
			Config::get('_query.filter_value') => Config::get('_mlp.status.rejected'),
		));

		$this->template->content = View::forge(
			'admin/index',
			array(
				'new_count'        => number_format($new_ml_proposals[Config::get('_result_key.total_results')]),
				'accepted_count'   => number_format($accepted_ml_proposals[Config::get('_result_key.total_results')]),
				'rejected_count'   => number_format($rejected_ml_proposals[Config::get('_result_key.total_results')]),
				'new_ml_proposals' => Helper::for_view_mlps($new_ml_proposals[Config::get('_result_key.items')]),
				'is_more'          => ($new_ml_proposals[Config::get('_result_key.total_results')] > 10),
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