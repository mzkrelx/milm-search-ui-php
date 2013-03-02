<?php
use Milm\Unicode;
use Milm\Api_UnexpectedStatusException;
use Milm\Http_Client;
use Milm\Http_Utils;
use Milm\Email_Admin;

use Fuel\Core\HttpServerErrorException;

/**
 * ML登録申請に関するロジッククラスです。
 */
class Model_Ml_Proposal
{
	/**
	 * ML登録申請情報のリストを取得します。
	 *
	 * @param  array $cond 取得条件。キー=Config::get('_result_key.xxxx')、値=キー項目の値
	 * @return array APIに準じて取得結果の配列が返ります。
	 */
	public static function find_list($cond)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').Http_Utils::make_query_string($cond)
		);
	}

	/**
	 * ML登録新生情報を1件取得します。
	 *
	 * @param  int $id
	 * @return array
	 */
	public static function find_by_id($id)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id);
	}

	/**
	 * ML登録申請します。
	 *
	 * @param  array $data 申請情報
	 * @return void
	 * @throws Api_Unexpectedstatusexception
	 */
	public static function propose($data)
	{
		Log::info("New ML Proposal!\n".array_to_string($data));

		Email_Admin::new_ml_proposal($data);

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

	/**
	 * 申請情報を更新します。
	 *
	 * @param  int $id
	 * @param  int $data
	 * @return void
	 */
	public static function update($id, $data)
	{
		Http_Client::put_json(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id,
			$data);
	}

	/**
	 * 申請を承認します。
	 *
	 * @param  int $id
	 * @return void
	 */
	public static function accept($id)
	{
		Http_Client::post(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id.
			'?accepted=true');

	}

	/**
	 * 申請を却下します。
	 *
	 * @param  int $id
	 * @return void
	 */
	public static function reject($id)
	{
		Http_Client::post(
			Config::get('_api_root_url').'/'.
			Config::get('_ml_proposals').'/'.$id.
			'?accepted=false');
	}
}