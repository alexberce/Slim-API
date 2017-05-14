<?php


namespace Invobox\Api\Validation;


use Invobox\Api\Response\ResponseStatusCodes;

class ValidationException extends \Exception
{
	const TYPE_MISMATCH = 0;
	const LENGTH_MISMATCH = 1;
	const REQUIRED_FIELD = 2;
	
	/**
	 * @var int
	 */
	private $exceptionClass;
	
	/**
	 * @var int
	 */
	private $exceptionType;
	
	/**
	 * @return int
	 */
	public static function getStatusCodeByExceptionCode(){
		return ResponseStatusCodes::HTTP_UNPROCESSABLE_ENTITY;
	}
	
	/**
	 * @param ValidationException $exception
	 *
	 * @return string
	 */
	public static function getErrorCodeByExceptionCode(ValidationException $exception){
		
		$exceptionNumber = str_pad($exception->getCode(), 5, '0', STR_PAD_LEFT);
		$exceptionClass =
			isset($exception->exceptionClass)
				? str_pad($exception->exceptionClass, 5, '0', STR_PAD_RIGHT)
				: 'V0000';
		
		return $exceptionClass . '-' . $exceptionNumber;
	}
	
	/**
	 * @param ValidationException $exception
	 *
	 * @return string
	 */
	public static function getErrorMessageByExceptionCode(ValidationException $exception){
		return $exception->getMessage();
	}
	
	/**
	 * @param int $exceptionClass
	 *
	 * @return $this
	 */
	public function withExceptionClass($exceptionClass){
		$this->exceptionClass = $exceptionClass;
		
		return $this;
	}
	
	/**
	 * @param int $exceptionType
	 *
	 * @return $this
	 */
	public function withExceptionType($exceptionType){
		$this->exceptionType = $exceptionType;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getExceptionClass(): int
	{
		return $this->exceptionClass;
	}
	
	/**
	 * @return int
	 */
	public function getExceptionType(): int
	{
		return $this->exceptionType;
	}
}