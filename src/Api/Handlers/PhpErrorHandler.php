<?php


namespace Invobox\Api\Handlers;


use Invobox\Api\Logger\LoggerInterface;
use Invobox\Api\Response\ResponseErrorCodes;
use Invobox\Api\Response\ResponseErrorMessages;
use Invobox\Api\Response\ResponseService;
use Invobox\Api\Response\ResponseStatusCodes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PhpErrorHandler
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
	 * PhpErrorHandler constructor.
	 *
	 * @param LoggerInterface $logger
	 */
	public function __construct(LoggerInterface $logger)
	{
		$this->logger          = $logger;
		$this->responseService = new ResponseService();
	}
	
	/**
	 * @param ServerRequestInterface $request
	 * @param ResponseInterface      $response
	 * @param \Throwable             $error
	 */
	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, \Throwable $error)
	{
		$this->responseService
			->withErrorMessage(ResponseErrorMessages::INTERNAL_SERVER_ERROR)
			->withStatusCode(ResponseStatusCodes::HTTP_INTERNAL_SERVER_ERROR)
			->withErrorCode(ResponseErrorCodes::RESPONSE_CODE_INTERNAL_SERVER_ERROR)
			->write();
		
		exit;
	}
}