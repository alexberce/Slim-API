<?php


namespace Invobox\Api\Resources\User;


use Invobox\Api\Resources\ResourceException;
use Invobox\Api\Response\ResponseService;
use Invobox\Api\Response\ResponseStatusCodes;
use Invobox\Api\UserContext\UserContextInterface;
use Invobox\Api\Validation\ValidationException;
use Slim\Http\Request;
use Slim\Http\Response;

class UserController
{
	
	/**
	 * @var UserService
	 */
	private $userService;
	
	/**
	 * @var ResponseService
	 */
	private $responseService;
	
	/**
	 * @var UserContextInterface
	 */
	private $userContext;
	
	/**
	 * @var UserPolicy
	 */
	private $usersPolicy;
	
	/**
	 * UsersController constructor.
	 *
	 * @param UserContextInterface $userContext
	 * @param UserService          $userService
	 * @param ResponseService      $responseService
	 * @param UserPolicy           $usersPolicy
	 */
	public function __construct(UserContextInterface $userContext, UserService $userService, ResponseService $responseService, UserPolicy $usersPolicy)
	{
		$this->userService     = $userService;
		$this->responseService = $responseService;
		$this->userContext     = $userContext;
		$this->usersPolicy     = $usersPolicy;
	}
	
	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param array    $args
	 *
	 * @throws ResourceException
	 */
	public function get(
		/** @noinspection PhpUnusedParameterInspection */
		Request $request, Response $response, array $args)
	{
		$userId = $request->getAttribute('id');
		
		if (!empty($userId) && is_numeric($userId)) {
			$data = $this->userService->getUserById($userId);
			
			if (!$this->usersPolicy->canGetUser($data)) {
				throw new ResourceException('Access denied', ResourceException::ACCESS_DENIED);
			}
		} else {
			$userId = $this->userContext->getId();
			$data = $this->userService->getAllUsers($userId);
		}
		
		$this->responseService->withData($data)->write();
	}
	
	public function me(
		/** @noinspection PhpUnusedParameterInspection */
		Request $request, Response $response, array $args)
	{
		
		$userId = $this->userContext->getId();
		$data = $this->userService->getUserById($userId);
		
		$this->responseService->withData($data)->write();
	}
	
	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param array    $args
	 *
	 * @return ResponseService
	 * @throws ValidationException
	 */
	public function create(
		/** @noinspection PhpUnusedParameterInspection */
		Request $request, Response $response, array $args)
	{
		$username = $request->getParam('name');
		$email    = $request->getParam('email');
		$password = $request->getParam('password');
		
		if (empty($username) || !is_string($username))
			throw (new ValidationException('The `name` field must be of type: string', UserException::INVALID_ARGUMENT_USERNAME))
				->withExceptionClass(UserException::EXCEPTION_CLASS);
		
		if (empty($email) || !is_string($email))
			throw (new ValidationException('The `email` field must be of type: email', UserException::INVALID_ARGUMENT_EMAIL))
				->withExceptionClass(UserException::EXCEPTION_CLASS);
		
		if (empty($password))
			throw (new ValidationException('The `password` field is required', UserException::INVALID_ARGUMENT_PASSWORD))
				->withExceptionClass(UserException::EXCEPTION_CLASS);
		
		//TODO: Implement create() method
		
		$userModel = new UserModelBuilder();
		$userModel
			->setUsername($username)
			->setEmail($email)
			->setPassword($password);
		
		$user = $this->userService->create($userModel->toArray());
		
		return $this->responseService
			->withData($user)
			->write();
	}
	
	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param array    $args
	 *
	 * @return ResponseService
	 * @throws ResourceException
	 * @throws ValidationException
	 */
	public function update(
		/** @noinspection PhpUnusedParameterInspection */
		Request $request, Response $response, array $args)
	{
		
		//TODO: Implement update() method
		
		throw new ResourceException('Access denied', ResourceException::ACCESS_DENIED);
	}
	
	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param array    $args
	 *
	 * @return ResponseService
	 * @throws ResourceException
	 * @throws ValidationException
	 */
	public function delete(
		/** @noinspection PhpUnusedParameterInspection */
		Request $request, Response $response, array $args)
	{
		$userId = $request->getAttribute('id');
		
		if (empty($userId) || !is_numeric($userId))
			throw (new ValidationException('The `id` field must be of type: integer', UserException::INVALID_ARGUMENT_USER_ID))
				->withExceptionClass(UserException::EXCEPTION_CLASS);
		
		$user = $this->userService->getUserById($userId);
		
		if ($this->usersPolicy->canDeleteUser($user)) {
			$this->userService->delete($userId);
			
			return $this->responseService
				->withMessage('User deleted')
				->withStatusCode(ResponseStatusCodes::HTTP_OK)
				->write();
		}
		
		throw new ResourceException('Access denied', ResourceException::ACCESS_DENIED);
	}
}