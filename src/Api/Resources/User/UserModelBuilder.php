<?php


namespace Invobox\Api\Resources\User;


class UserModelBuilder
{
	
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
	 * @var string
	 */
	private $email;
	
	/**
	 * @var string
	 */
	private $username;
	
	/**
	 * @var string
	 */
	private $password;
	
	/**
	 * @var bool
	 */
	private $isAdmin;
	
	/**
	 * @var string
	 */
	private $createdOn;
	
	/**
	 * @var int
	 */
	private $createdBy;
	
	/**
	 * @var bool
	 */
	private $confirmed;
	
	/**
	 * @param int $id
	 *
	 * @return UserModelBuilder
	 */
	public function setId(int $id): UserModelBuilder
	{
		$this->id = $id;
		
		return $this;
	}
	
	/**
	 * @param int $accountId
	 *
	 * @return UserModelBuilder
	 */
	public function setAccountId(int $accountId): UserModelBuilder
	{
		$this->accountId = $accountId;
		
		return $this;
	}
	
	/**
	 * @param int $parentId
	 *
	 * @return UserModelBuilder
	 */
	public function setParentId(int $parentId): UserModelBuilder
	{
		$this->parentId = $parentId;
		
		return $this;
	}
	
	/**
	 * @param string $email
	 *
	 * @return UserModelBuilder
	 */
	public function setEmail(string $email): UserModelBuilder
	{
		$this->email = $email;
		
		return $this;
	}
	
	/**
	 * @param string $username
	 *
	 * @return UserModelBuilder
	 */
	public function setUsername(string $username): UserModelBuilder
	{
		$this->username = $username;
		
		return $this;
	}
	
	/**
	 * @param string $password
	 *
	 * @return UserModelBuilder
	 */
	public function setPassword(string $password): UserModelBuilder
	{
		$this->password = $password;
		
		return $this;
	}
	
	/**
	 * @param bool $isAdmin
	 *
	 * @return UserModelBuilder
	 */
	public function setIsAdmin(bool $isAdmin): UserModelBuilder
	{
		$this->isAdmin = $isAdmin;
		
		return $this;
	}
	
	/**
	 * @param string $createdOn
	 *
	 * @return UserModelBuilder
	 */
	public function setCreatedOn(string $createdOn): UserModelBuilder
	{
		$this->createdOn = $createdOn;
		
		return $this;
	}
	
	/**
	 * @param int $createdBy
	 *
	 * @return UserModelBuilder
	 */
	public function setCreatedBy(int $createdBy): UserModelBuilder
	{
		$this->createdBy = $createdBy;
		
		return $this;
	}
	
	/**
	 * @param bool $confirmed
	 *
	 * @return UserModelBuilder
	 */
	public function setConfirmed(bool $confirmed): UserModelBuilder
	{
		$this->confirmed = $confirmed;
		
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function toArray()
	{
		$data = [];
		
		if(isset($this->id))
			$data['id'] = $this->id;
		
		if(isset($this->accountId))
			$data['accountId'] = $this->accountId;
		
		if(isset($this->parentId))
			$data['parentId'] = $this->parentId;
		
		if(isset($this->email))
			$data['email'] = $this->email;
		
		if(isset($this->username))
			$data['username'] = $this->username;
		
		if(isset($this->password))
			$data['password'] = $this->password;
		
		if(isset($this->isAdmin))
			$data['isAdmin'] = $this->isAdmin;
		
		if(isset($this->createdOn))
			$data['createdOn'] = $this->createdOn;
		
		if(isset($this->createdBy))
			$data['createdBy'] = $this->createdBy;
		
		if(isset($this->confirmed))
			$data['confirmed'] = $this->confirmed;
		
		return $data;
	}
}