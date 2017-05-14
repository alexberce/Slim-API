<?php


namespace Invobox\Api\Handlers;


use Invobox\Api\Logger\LoggerInterface;
use Invobox\Api\Response\ResponseErrorCodes;
use Invobox\Api\Response\ResponseErrorMessages;
use Invobox\Api\Response\ResponseService;
use Invobox\Api\Response\ResponseStatusCodes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotFoundHandler
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
	 * NotFoundHandler constructor.
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
	 *
	 * @return mixed
	 */
	public function __invoke(ServerRequestInterface $request, ResponseInterface $response)
	{
		$this->responseService
			->withErrorMessage(ResponseErrorMessages::NOT_FOUND)
			->withStatusCode(ResponseStatusCodes::HTTP_NOT_FOUND)
			->withErrorCode(ResponseErrorCodes::RESPONSE_CODE_NOT_FOUND)
			->write();
		
		exit;
	}
}