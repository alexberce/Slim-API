<?php


namespace Invobox\Api\Resources\User;


use Invobox\Api\UserContext\UserContextInterface;

class UserPolicy
{
	/**
	 * @var UserContextInterface
	 */
	private $userContext;
	
	/**
	 * UsersPolicy constructor.
	 *
	 * @param UserContextInterface $userContext
	 */
	public function __construct(UserContextInterface $userContext)
	{
		$this->userContext = $userContext;
	}
	
	public function canGetUser(UserModel $userModel)
	{
		return $this->userContext->getId() === $userModel->getId() || $this->userContext->getId() === $userModel->getParentId();
	}
	
	public function canUpdateUser(UserModel $userModel)
	{
		return $this->canGetUser($userModel);
	}
	
	public function canDeleteUser(UserModel $userModel)
	{
		return $this->canGetUser($userModel);
	}
}