<?php


namespace Invobox\Api\Resources\User;


use Invobox\Api\Logger\LoggerInterface;
use Invobox\Api\Resources\ResourceException;

class UserService
{
	/**
	 * @var LoggerInterface
	 */
	private $logger;
	
	/**
	 * @var UserDAO
	 */
	private $dao;
	
	/**
	 * @var UserModelBuilder
	 */
	private $userModelBuilder;
	
	/**
	 * UsersService constructor.
	 *
	 * @param UserDAO              $dao
	 * @param LoggerInterface      $logger
	 * @param UserModelBuilder     $userModelBuilder
	 */
	public function __construct(UserDAO $dao, LoggerInterface $logger, UserModelBuilder $userModelBuilder)
	{
		$this->logger = $logger;
		$this->dao = $dao;
		$this->userModelBuilder = $userModelBuilder;
	}
	
	/**
	 * @param $id
	 *
	 * @return UserModel
	 */
	public function getUserById($id){
		$user = new UserModel($this->dao->getUserById($id));
		
		return $user;
	}
	
	/**
	 * @param $userId
	 *
	 * @return array
	 */
	public function getAllUsers($userId){
		$userModels = [];
		$users = $this->dao->getAllUsersVisibleByThisUser($userId);
		
		foreach($users as $user)
			$userModels[] = (new UserModel($user))->expose();
		
		return $userModels;
	}
	
	/**
	 * @param array $data
	 *
	 * @return UserModel
	 */
	public function create(array $data){
		$userId = $this->dao->createUser($data);
		
		return $this->getUserById($userId);
	}
	
	/**
	 * @param       $id
	 * @param array $data
	 *
	 * @return UserModel
	 */
	public function update($id, array $data){
		$this->dao->updateUser($id, $data);
		
		$user = $this->getUserById($id);
		
		return $user;
	}
	
	/**
	 * @param $id
	 */
	public function delete($id){
		$this->dao->deleteUserById($id);
	}
	
	/**
	 * @param $username
	 * @param $password
	 *
	 * @return UserModel
	 * @throws ResourceException
	 */
	public function getUserByUsernameAndPassword($username, $password)
	{
		$user = new UserModel($this->dao->getUserByUsername($username));
		
		if(!password_verify($password, $user->getPassword()))
			throw new ResourceException('Incorrect password', ResourceException::NOT_FOUND);
		
		return $user;
	}
}