<?php


namespace Invobox\Api\Utils;


class Environment
{
	public static $productionDomains = [
		'api.invobox.com'
	];
	
	public static $developmentDomains = [
		'localhost',
		'127.0.0.1',
		'127.0.0.1:8080',
	    'local.invobox.com',
	    'testing.invobox.com'
	];
	
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
	
	public static function getServerUrl(){
		return $_SERVER['HTTP_HOST'];
	}
}