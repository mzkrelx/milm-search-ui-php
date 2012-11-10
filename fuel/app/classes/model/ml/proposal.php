<?php
use Milm\Http_Client;
use Milm\Http_Utils;

use Fuel\Core\HttpServerErrorException;

/**
 * ML登録申請に関するロジッククラスです。
 */
class Model_Ml_Proposal
{
	/**
	 * 絞り込み項目
	 */
	const FILTER_BY_STATUS = 'status';

	/**
	 * 並べ替え項目
	 */
	const SORT_BY_ML_TITLE     = 'mlTitle';
	const SORT_BY_STATUS       = 'status';
	const SORT_BY_ARCHIVE_TYPE = 'archiveType';
	const SORT_BY_CREATED_AT   = 'createdAt';
	const SORT_BY_UPDATED_AT   = 'updatedAt';

	/**
	 * ステータス値
	 */
	const STATUS_NEW      = 'new';
	const STATUS_ACCEPTED = 'accepted';
	const STATUS_REJECTED = 'rejected';

	/**
	 * ML登録申請情報のリストを取得します。
	 *
	 * @param  array $cond 取得条件。キー=Milm_Api::QUERY_XX、値=キー項目の値
	 * @return array APIに準じて取得結果の配列が返ります。
	 */
	public static function find_list($cond)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').Http_Utils::makeQueryString($cond)
		);
	}

	public static function find_by_id($id)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id);
	}

}