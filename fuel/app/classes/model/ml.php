<?php
use Model\Http\Client;

use Fuel\Core\HttpServerErrorException;

class Model_Ml
{
	public static function find_list($cond)
	{
		return Model_Http_Client::get_array(Config::get('_api_root_url').'/mls');
	}

	public static function find_by_id($id)
	{
		return Model_Http_Client::get_array(Config::get('_api_root_url').'/mls/'.$id);
	}

}