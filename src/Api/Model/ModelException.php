<?php


namespace Invobox\Api\Model;


use Invobox\Api\Response\ResponseStatusCodes;

class ModelException
{
	const NOT_FOUND     = 0;
	const ACCESS_DENIED = 1;
	
	public static function getStatusCodeByExceptionCode($exceptionCode){
		switch($exceptionCode){
			case self::NOT_FOUND:
				return ResponseStatusCodes::HTTP_NOT_FOUND;
				break;
			case self::ACCESS_DENIED:
				return ResponseStatusCodes::HTTP_UNAUTHORIZED;
				break;
			default:
				return ResponseStatusCodes::HTTP_BAD_REQUEST;
				break;
		}
	}
}