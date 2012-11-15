<?php
namespace Milm;

require_once 'Zend/Date.php';

class Controller_Helper
{
	public static $default_ml_proposals_cols = array('id', 'createdAt', 'mlTitle');
	public static $default_ml_proposal_cols = array(
		'proposerName',
		'proposerEmail',
		'mlTitle',
		'status',
		'archiveType',
		'archiveUrl',
		'comment',
		'createdAt',
		'updatedAt',
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
			if ('createdAt' === $col or 'updatedAt' === $col) {
				$date = new \Zend_Date($val, \Zend_Date::ISO_8601);
				$val = $date->toString('y/MM/dd');
			}
			$for_view_mlp[$col] = $val;
		}
		return $for_view_mlp;
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