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
namespace Milm;

use Fuel\Core\Config;

require_once 'Zend/Date.php';

class Controller_Helper
{
	public static $default_ml_proposals_cols = array(
		'id',
		'created_at',
		'ml_title',
	);
	public static $default_ml_proposal_cols = array(
		'proposer_name',
		'proposer_email',
		'ml_title',
		'status',
		'archive_type',
		'archive_u_r_l',
		'comment',
		'created_at',
		'updated_at',
	);

	public static $default_mls_cols = array(
		'id',
		'title',
		'archive_u_r_l',
		'last_mailed_at',
	);

	/**
	 * GET もしくは POST のパラメータを取得します。URLパラメータは取得できません。
	 *
	 * @param  string $name    パラメータ名
	 * @param  mixed  $default デフォルト値
	 * @return mixed
	*/
	public static function get_param($name, $default = null)
	{
		$value = null;
		if (isset($_GET[$name])) {
			$value = $_GET[$name];
		} elseif (isset($_POST[$name])) {
			$value = $_POST[$name];
		}

		if ((null === $value or '' === $value) and (null !== $default)) {
			return $default;
		}

		return $value;
	}

	/**
	 * ML登録申請情報をビュー用に変換します。
	 *
	 * @param  array $ml_proposals ML登録申請情報
	 * @param  array $cols         表示する項目名。これに入っていないカラムは戻り値に含まれません。
	 * @return array
	 */
	public static function for_view_mlp($ml_proposal, $cols = array())
	{
	    if (empty($cols)) {
	        $cols = self::$default_ml_proposal_cols;
	    }
	    return self::create_for_view_mlp($ml_proposal, $cols);
	}

	/**
	 * ML登録申請情報の配列をビュー用に変換します。
	 *
	 * @param  array $ml_proposals ML登録申請情報
	 * @param  array $cols         表示する項目名。これに入っていないカラムは戻り値に含まれません。
	 * @return array
	 */
	public static function for_view_mlps($ml_proposals, $cols = array())
	{
		if (empty($cols)) {
			$cols = self::$default_ml_proposals_cols;
		}
		$for_view_mlps = array();
		foreach ($ml_proposals as $ml_proposal) {
			$for_view_mlps[] = self::create_for_view_mlp($ml_proposal, $cols);
		}
		return $for_view_mlps;
	}

	private static function create_for_view_mlp($ml_proposal, $cols)
	{
		$for_view_mlp = array();
		foreach ($cols as $col) {
			$val = $ml_proposal[$col];
			if ('created_at' === $col or 'updated_at' === $col) {
				if ($val != null) {
					$date = new \Zend_Date($val, \Zend_Date::ISO_8601);
					$val = $date->toString('y/MM/dd');
				}
			}
			if ('archive_type' === $col) {
				$val = self::to_archive_type_label($val);
			}
			$for_view_mlp[$col] = $val;
		}
		return $for_view_mlp;
	}

	/**
	 * MLの配列をビュー用に変換します。
	 *
	 * @param  array $mls ML情報
	 * @param  array $cols 表示する項目名。これに入っていないカラムは戻り値に含まれません。
	 * @return array
	 */
	public static function for_view_mls($mls, $cols = array())
	{
		if (empty($cols)) {
			$cols = self::$default_mls_cols;
		}
		$for_views = array();
		foreach ($mls as $ml) {
			$for_views[] = self::create_for_view_ml($ml, $cols);
		}
		return $for_views;
	}

	private static function create_for_view_ml($ml, $cols)
	{
		$for_view_ml = array();
		foreach ($cols as $col) {
			$val = $ml[$col];
			if ('last_mailed_at' === $col or
				'created_at'     === $col or
				'updated_at'     === $col) {
				if ($val != null) {
					$date = new \Zend_Date($val, \Zend_Date::ISO_8601);
					$val = $date->toString('y/MM/dd');
				}
			}
			if ('archive_type' === $col) {
				$val = self::to_archive_type_label($val);
			}
			$for_view_ml[$col] = $val;
		}
		return $for_view_ml;
	}

	public static function to_archive_type_label($archive_type)
	{
		switch ($archive_type) {
		case Config::get('_ml_archive_type.mailman') :
			return Config::get('_ml_archive_type.mailman_label');
		case Config::get('_ml_archive_type.other') :
			return Config::get('_ml_archive_type.other_label');
		default :
			return false;
		}
	}

	/**
	 * POSTメソッドのアクセスかどうか判断します。
	 *
	 * @return boolean POST なら true
	 */
	public static function is_post()
	{
		return $_SERVER['REQUEST_METHOD'] === 'POST';
	}
}