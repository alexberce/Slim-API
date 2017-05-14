<?php


namespace Invobox\Api\Database;


use Invobox\Api\Response\ResponseErrorMessages;
use Invobox\Api\Response\ResponseStatusCodes;
use Invobox\Api\Response\ResponseErrorCodes;

class DatabaseException extends \Exception
{
	const NOT_FOUND = 0;
	
	public static function getStatusCodeByExceptionCode($exceptionCode){
		switch($exceptionCode){
			case self::NOT_FOUND:
				return ResponseStatusCodes::HTTP_NOT_FOUND;
				break;
			default:
				return ResponseStatusCodes::HTTP_BAD_REQUEST;
				break;
		}
	}
	
	public static function getErrorCodeByExceptionCode($exceptionCode){
		switch($exceptionCode){
			case self::NOT_FOUND:
				return ResponseErrorCodes::RESPONSE_CODE_NOT_FOUND;
				break;
			default:
				return ResponseErrorCodes::RESPONSE_BAD_REQUEST;
				break;
		}
	}
	
	public static function getErrorMessageByExceptionCode($exceptionCode){
		switch($exceptionCode){
			case self::NOT_FOUND:
				return ResponseErrorMessages::NOT_FOUND;
				break;
			default:
				return ResponseErrorMessages::UNKNOWN_ERROR;
				break;
		}
	}
}