<?php


namespace Invobox\Config\Settings;


use Invobox\Api\Utils\Environment;

class Settings
{
	public static function getApplicationSettingsFile(){
		switch(true){
			case Environment::isDevelopment():
				return __DIR__ . '/development.php';
				break;
			case Environment::isProduction():
				// This is the default environment
			default:
				return __DIR__ . '/production.php';
				break;
		}
	}
}