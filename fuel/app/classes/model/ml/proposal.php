<?php
use Milm\Unicode;
use Milm\Api_UnexpectedStatusException;
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
	 * MLアーカイブタイプ
	 */
	const ARCHIVE_TYPE_MAILMAN = "mailman";
	const ARCHIVE_TYPE_OTHER   = "other";

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
			Config::get('_ml_proposals').Http_Utils::make_query_string($cond)
		);
	}

	public static function find_by_id($id)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id);
	}

	public static function create($data)
	{
		$response = Http_Client::post_json(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals'),
			$data);

		if ($response->getStatus() != 201) {
			throw new Api_Unexpectedstatusexception(
				'ML登録申請情報登録時にAPIが予期せぬHTTPステータスを返しました。:'.$response->getBody()
			);
		}

		Log::info('Status: '.$response->getStatus().
			', Body: '.Unicode::decode($response->getBody()), __METHOD__
		);
	}

	public static function update($id, $data)
	{
		Http_Client::put_json(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id,
			$data);
	}

}