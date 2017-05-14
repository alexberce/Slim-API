<?php

namespace Invobox\Api\Authentication;

use Firebase\JWT\JWT;
use Invobox\Api\Database\DatabaseException;
use Invobox\Api\Resources\User\UserService;

class AuthenticationService
{
	/**
	 * @var UserService
	 */
	private $userService;
	
	/**
	 * AuthenticationService constructor.
	 *
	 * @param UserService $usersService
	 */
	public function __construct(UserService $usersService)
	{
		$this->userService = $usersService;
	}
	
	/**
	 * @param $username
	 * @param $password
	 *
	 * @return string
	 * @throws AuthenticationException
	 */
	public function createToken($username, $password)
	{
		try {
			$userModel = $this->userService->getUserByUsernameAndPassword($username, $password);
			$payload   = [
				'uid' => $userModel->getId(),
				"iat" => strtotime(date("Y-m-d H:i:s")),
				"exp" => strtotime(
					(new \DateTime('+1 day'))
						->format('Y-m-d H:i:s')
				),
				'iss' => 'api.invobox.com',
			];
			
			$key = 'SECRET_HERE';
			
			return JWT::encode($payload, $key);
		} catch (DatabaseException $exception) {
			throw new AuthenticationException('Wrong user credentials', AuthenticationException::WRONG_USER_CREDENTIALS);
		}
	}
	
}