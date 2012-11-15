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

	/**
	 * 配列を json にして Body にセットし、PUT メソッドで URL にアクセスします。
	 *
	 * @param  string $url   URL
	 * @param  array  $array json に変換される body
	 * @throws HttpServerErrorException
	 */
	public static function put_json($url, $array)
	{
		$json = Format::forge($array)->to_json();

		$http_client = new \Zend_Http_Client($url);
		$http_client->setRawData($json, 'application/json')
			->setHeaders(array('Content-Type' => '"appliction/json"; charset=utf-8'));

		$response = $http_client->request('PUT');

		if ($response->getStatus() != 204) {
			throw new HttpServerErrorException('サーバーエラー:'.$response->getBody());
		}
	}
}