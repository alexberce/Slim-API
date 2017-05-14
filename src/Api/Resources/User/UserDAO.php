<?php


namespace Invobox\Api\Resources\User;


use Invobox\Api\Database\Database;
use Invobox\Api\Database\DatabaseException;

class UserDAO
{
	/**
	 * @var Database
	 */
	private $database;
	
	/**
	 * UserDAO constructor.
	 *
	 * @param Database $database
	 */
	public function __construct(Database $database)
	{
		$this->database = $database;
	}
	
	/**
	 * @param int $id
	 *
	 * @return array
	 * @throws DatabaseException
	 */
	public function getUserById($id){
		$query = 'SELECT * FROM users WHERE id = :id LIMIT 1';
		$statement = $this->database->prepare($query);
		$statement->bindParam('id', $id, Database::PARAM_INT);
		$statement->execute();
		$result = $statement->fetch();
		
		if(!$result)
			throw new DatabaseException('User #' . (int) $id . ' not found!', DatabaseException::NOT_FOUND);
		
		return $result;
	}
	
	/**
	 * return array
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public function getAllUsersVisibleByThisUser($id)
	{
		$query = 'SELECT * FROM users WHERE id = :id OR parentId = :id ORDER BY id = :id DESC';
		$statement = $this->database->prepare($query);
		$statement->bindParam('id', $id, Database::PARAM_INT);
		$statement->execute();
		
		$result = $statement->fetchAll();
		
		return $result;
	}
	
	/**
	 * @param $accountId
	 *
	 * @return array
	 */
	public function getAllAccountUsers($accountId){
		$query = 'SELECT * FROM users WHERE accountId = :accountId';
		$statement = $this->database->prepare($query);
		$statement->bindParam('accountId', $accountId, Database::PARAM_INT);
		$statement->execute();
		
		$result = $statement->fetchAll();
		
		return $result;
	}
	
	/**
	 * @param $username
	 *
	 * @return mixed
	 * @throws DatabaseException
	 */
	public function getUserByUsername($username)
	{
		$query = 'SELECT * FROM users WHERE username = :username LIMIT 1';
		$statement = $this->database->prepare($query);
		$statement->bindParam('username', $username, Database::PARAM_STR);
		$statement->execute();
		
		$result = $statement->fetch();
		
		if(!$result)
			throw new DatabaseException('User #' . $username . ' not found!', DatabaseException::NOT_FOUND);
		
		return $result;
	}
	
	/**
	 * @param array $data
	 *
	 * @return string
	 */
	public function createUser(array $data)
	{
		//TODO: Implement createUser() method
		
		return $this->database->lastInsertId();
	}
	
	/**
	 * @param       $id
	 * @param array $data
	 */
	public function updateUser($id, array $data)
	{
		//TODO: Implement updateUser() method
	}
	
	/**
	 * @param $id
	 */
	public function deleteUserById($id)
	{
		$query = 'DELETE FROM users WHERE id = :id LIMIT 1';
		$statement = $this->database->prepare($query);
		$statement->bindParam('id', $id, Database::PARAM_INT);
		$statement->execute();
	}
}