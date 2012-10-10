<?php
use Model\Http\Client;

use Fuel\Core\HttpServerErrorException;

/**
 * ML登録申請に関するロジッククラスです。
 */
class Model_Ml_Proposal
{
	public static function find_list($cond)
	{
		return Model_Http_Client::get_array(Config::get('_api_root_url').'/mlproposals');
	}

	public static function find_by_id($id)
	{
		return Model_Http_Client::get_array(Config::get('_api_root_url').'/mlproposals/'.$id);
	}

}