<?php
namespace Milm;

use Fuel\Core\Format;
use Fuel\Core\HttpServerErrorException;
use Fuel\Core\Config;

require_once 'Zend/Http/Client.php';

class Http_Client
{
	/**
	 * json が返る URL にアクセスして、配列にして返します。
	 *
	 * @param  string $json_url
	 * @throws HttpServerErrorException
	 * @return array
	 */
	public static function get_array($json_url)
	{
		$http_client = new \Zend_Http_Client($json_url);
		$response = $http_client->request('GET');

		if ($response->isError()) {
		    throw new HttpServerErrorException();
		}

		$array = Format::forge(Unicode::decode($response->getBody()), 'json')->to_array();
		return $array;
	}
}