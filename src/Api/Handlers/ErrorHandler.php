<?php

namespace Invobox\Api\Handlers;

use Invobox\Api\Authentication\AuthenticationException;
use Invobox\Api\Database\DatabaseException;
use Invobox\Api\Logger\LoggerInterface;
use Invobox\Api\Resources\ResourceException;
use Invobox\Api\Response\ResponseErrorCodes;
use Invobox\Api\Response\ResponseErrorMessages;
use Invobox\Api\Response\ResponseService;
use Invobox\Api\Response\ResponseStatusCodes;
use Invobox\Api\Validation\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Handlers\Error;

class ErrorHandler extends Error
{
	/**
	 * @var LoggerInterface
	 */
	protected $logger;
	
	/**
	 * @var ResponseService
	 */
	private $responseService;
	
	/**
	 * ErrorHandler constructor.
	 *
	 * @param LoggerInterface $logger
	 */
	public function __construct(LoggerInterface $logger)
	{
		parent::__construct();
		$this->logger          = $logger;
		$this->responseService = new ResponseService();
	}
	
	/**
	 * @param ServerRequestInterface $request
	 * @param ResponseInterface      $response
	 * @param \Exception             $exception
	 *
	 * @return mixed
	 */
	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, \Exception $exception)
	{
		
		list($statusCode, $errorCode, $errorMessage) = $this->getExceptionInfoByExceptionType($exception);
		
		$this->responseService
			->withErrorMessage($errorMessage)
			->withStatusCode($statusCode)
			->withErrorCode($errorCode)
			->write();
		
		exit;
	}
	
	private function getExceptionInfoByExceptionType(\Exception $exception)
	{
		switch (true) {
			case $exception instanceof DatabaseException:
				$statusCode   = DatabaseException::getStatusCodeByExceptionCode($exception->getCode());
				$errorCode    = DatabaseException::getErrorCodeByExceptionCode($exception->getCode());
				$errorMessage = DatabaseException::getErrorMessageByExceptionCode($exception->getCode());
				break;
			case $exception instanceof ResourceException:
				$statusCode   = ResourceException::getStatusCodeByExceptionCode($exception->getCode());
				$errorCode    = ResourceException::getErrorCodeByExceptionCode($exception->getCode());
				$errorMessage = ResourceException::getErrorMessageByExceptionCode($exception->getCode());
				break;
			case $exception instanceof AuthenticationException:
				$statusCode   = AuthenticationException::getStatusCodeByExceptionCode($exception);
				$errorCode    = AuthenticationException::getErrorCodeByExceptionCode($exception);
				$errorMessage = AuthenticationException::getErrorMessageByExceptionCode($exception);
				break;
			case $exception instanceof ValidationException:
				$statusCode   = ValidationException::getStatusCodeByExceptionCode();
				$errorCode    = ValidationException::getErrorCodeByExceptionCode($exception);
				$errorMessage = ValidationException::getErrorMessageByExceptionCode($exception);
				break;
			default:
				$statusCode   = ResponseStatusCodes::HTTP_BAD_REQUEST;
				$errorCode    = ResponseErrorCodes::RESPONSE_BAD_REQUEST;
				$errorMessage = ResponseErrorMessages::UNKNOWN_ERROR;
				break;
		}
		
		return [$statusCode, $errorCode, $errorMessage];
	}
}