<?php


namespace Invobox\Api\Utils;


class Environment
{
	const TESTING_DOMAIN = 'testing.example.com';
	
	public static $productionDomains = [
		'api.example.com'
	];
	
	public static $developmentDomains = [
		'localhost',
		'127.0.0.1',
		'127.0.0.1:8080',
	    'local.example.com',
	    self::TESTING_DOMAIN,
	];
	
	public static $jwtSecretKey = 'SECRET_KEY';
	
	/**
	 * @return bool
	 */
	public static function isProduction(){
		return in_array(self::getServerUrl(), self::$productionDomains);
	}
	
	/**
	 * @return bool
	 */
	public static function isDevelopment()
	{
		return in_array(self::getServerUrl(), self::$developmentDomains);
	}
	
	/**
	 * @return mixed
	 */
	public static function getServerUrl(){
		return $_SERVER['HTTP_HOST'];
	}
}