<?php
use Milm\Http_Client;

use Model\Http\Client;

use Fuel\Core\HttpServerErrorException;

class Model_Ml
{
	public static function find_list($cond)
	{
		// TODO 例外処理
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_mls')
		);
	}

	public static function find_by_id($id)
	{
		return Http_Client::get_array(
			Config::get('_api_root_url').'/'.
			Config::get('_mls').$id
		);
	}

}