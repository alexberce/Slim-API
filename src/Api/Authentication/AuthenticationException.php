<?php


namespace Invobox\Api\Authentication;


use Invobox\Api\Response\ResponseErrorCodes;
use Invobox\Api\Response\ResponseErrorMessages;
use Invobox\Api\Response\ResponseStatusCodes;

class AuthenticationException extends \Exception
{
	const WRONG_USER_CREDENTIALS = 1;
	
	public static function getStatusCodeByExceptionCode(AuthenticationException $exception){
		
		$exceptionCode = $exception->getCode();
		
		switch($exceptionCode){
			case self::WRONG_USER_CREDENTIALS:
				return ResponseStatusCodes::HTTP_UNAUTHORIZED;
				break;
			default:
				return ResponseStatusCodes::HTTP_BAD_REQUEST;
				break;
		}
	}
	
	public static function getErrorCodeByExceptionCode(AuthenticationException $exception){
		$exceptionCode = $exception->getCode();
		
		switch($exceptionCode){
			case self::WRONG_USER_CREDENTIALS:
				return ResponseErrorCodes::RESPONSE_CODE_UNAUTHORIZED;
				break;
			default:
				return ResponseErrorCodes::RESPONSE_BAD_REQUEST;
				break;
		}
	}
	
	public static function getErrorMessageByExceptionCode(AuthenticationException $exception){
		$exceptionCode = $exception->getCode();
		
		switch($exceptionCode){
			case self::WRONG_USER_CREDENTIALS:
				return $exception->getMessage();
				break;
			default:
				return ResponseErrorMessages::UNKNOWN_ERROR;
				break;
		}
	}
}