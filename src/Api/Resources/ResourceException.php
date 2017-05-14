<?php


namespace Invobox\Api\Resources;


use Invobox\Api\Response\ResponseErrorCodes;
use Invobox\Api\Response\ResponseErrorMessages;
use Invobox\Api\Response\ResponseStatusCodes;

class ResourceException extends \Exception
{
	const NOT_FOUND = 0;
	const VALIDATION_ERROR = 1;
	const ACCESS_DENIED = 2;
	
	public static function getStatusCodeByExceptionCode($exceptionCode){
		switch($exceptionCode){
			case self::NOT_FOUND:
				return ResponseStatusCodes::HTTP_NOT_FOUND;
				break;
			case self::VALIDATION_ERROR:
				return ResponseStatusCodes::HTTP_UNPROCESSABLE_ENTITY;
				break;
			case self::ACCESS_DENIED:
				return ResponseStatusCodes::HTTP_UNAUTHORIZED;
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
				return ResponseErrorCodes::RESPONSE_CODE_UNKNOWN_ERROR;
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