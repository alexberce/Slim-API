<?php


namespace Invobox\Api\Handlers;


use Invobox\Api\Logger\LoggerInterface;
use Invobox\Api\Response\ResponseErrorCodes;
use Invobox\Api\Response\ResponseErrorMessages;
use Invobox\Api\Response\ResponseService;
use Invobox\Api\Response\ResponseStatusCodes;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class NotAllowedHandler
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
	 * NotAllowedHandler constructor.
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
	 * @param array                  $methods
	 *
	 * @return mixed
	 */
	public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $methods)
	{
		$this->responseService
			->withErrorMessage(sprintf(ResponseErrorMessages::METHOD_NOT_ALLOWED, implode(',', $methods)))
			->withStatusCode(ResponseStatusCodes::HTTP_METHOD_NOT_ALLOWED)
			->withErrorCode(ResponseErrorCodes::RESPONSE_CODE_METHOD_NOT_ALLOWED)
			->write();
		
		exit;
	}
}