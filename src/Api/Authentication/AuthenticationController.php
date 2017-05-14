<?php

namespace Invobox\Api\Authentication;

use Invobox\Api\Response\ResponseService;
use Slim\Http\Request;
use Slim\Http\Response;

class AuthenticationController
{
	/**
	 * @var AuthenticationService
	 */
	private $authenticationService;
	
	/**
	 * @var ResponseService
	 */
	private $responseService;
	
	/**
	 * AuthenticationController constructor.
	 *
	 * @param AuthenticationService $authenticationService
	 * @param ResponseService       $responseService
	 */
	public function __construct(AuthenticationService $authenticationService, ResponseService $responseService)
	{
		$this->authenticationService = $authenticationService;
		$this->responseService       = $responseService;
	}
	
	
	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param array    $args
	 */
	public function createToken(Request $request, Response $response, array $args)
	{
		$username = $request->getParam('username');
		$password = $request->getParam('password');
		
		$token = $this->authenticationService->createToken($username, $password);
		
		$data = [
			'token' => $token,
		];
		
		$this->responseService->withData($data)->write();
	}
	
	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param array    $args
	 */
	public function refreshToken(Request $request, Response $response, array $args)
	{
		//TODO: Implement refreshToken() method
	}
	
	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param array    $args
	 */
	public function invalidateToken(Request $request, Response $response, array $args)
	{
		//TODO: Implement invalidateToken() method
	}
}