<?php

namespace Invobox\Api\UserContext;

use Invobox\Api\Resources\User\UserService;

class UserContext implements UserContextInterface
{
	/**
	 * @var bool
	 */
	private $isInitialized = false;
	
	/**
	 * @var UserService
	 */
	private $usersService;
	
	/**
	 * @var
	 */
	private $jwt;
	
	/**
	 * @var int
	 */
	private $id;
	
	/**
	 * @var int
	 */
	private $accountId;
	
	/**
	 * @var int
	 */
	private $parentId;
	
	/**
	 * @var bool
	 */
	private $isAdmin;
	
	
	/**
	 * UserContext constructor.
	 *
	 * @param UserService $usersService
	 */
	public function __construct(UserService $usersService)
	{
		$this->usersService = $usersService;
	}
	
	/**
	 * @param mixed $jwt
	 */
	public function setJwt($jwt)
	{
		$this->jwt = $jwt;
	}
	
	/**
	 * @return int
	 */
	public function getId()
	{
		$this->lazyInit();
		
		return $this->id;
	}
	
	/**
	 * @return int
	 */
	public function getAccountId()
	{
		$this->lazyInit();
		
		return $this->accountId;
	}
	
	/**
	 * @return int
	 */
	public function getParentId(){
		$this->lazyInit();
		
		return $this->parentId;
	}
	
	/**
	 * @return bool
	 */
	public function isAdmin()
	{
		$this->lazyInit();
		
		return $this->isAdmin;
	}
	
	private function lazyInit()
	{
		if (!$this->isInitialized && is_object($this->jwt) && is_numeric($this->jwt->uid)) {
			
			try {
				$userModel = $this->usersService->getUserById($this->jwt->uid);
				
				$this->id = $userModel->getId();
				$this->accountId = $userModel->getAccountId();
				$this->parentId = $userModel->getParentId();
				$this->isAdmin = $userModel->isAdmin();
				
				$this->isInitialized = true;
			} catch (\Exception $e) {
			
			}
		}
	}
}