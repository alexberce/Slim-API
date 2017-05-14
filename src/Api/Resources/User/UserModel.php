<?php


namespace Invobox\Api\Resources\User;


use Invobox\Api\Resources\ResourceModel;
use Invobox\Api\Resources\ResourceModelInterface;

class UserModel extends ResourceModel implements ResourceModelInterface
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
	
	protected $hidden = [
		'password',
	];
	
	/**
	 * UserModel constructor.
	 *
	 * @param array $dao
	 */
	public function __construct(array $dao)
	{
		$this->id        = (int) $dao['id'];
		$this->accountId = (int) $dao['accountId'];
		$this->parentId  = (int) $dao['parentId'];
		$this->email     = (string) $dao['email'];
		$this->username  = (string) $dao['username'];
		$this->password  = (string) $dao['password'];
		$this->isAdmin   = (bool) $dao['isAdmin'];
		$this->createdOn = (string) $dao['createdOn'];
		$this->createdBy = (int) $dao['createdBy'];
		$this->confirmed = (bool) $dao['confirmed'];
	}
	
	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}
	
	/**
	 * @return int
	 */
	public function getAccountId(): int
	{
		return $this->accountId;
	}
	
	/**
	 * @return int
	 */
	public function getParentId(): int
	{
		return $this->parentId;
	}
	
	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}
	
	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}
	
	/**
	 * @return bool
	 */
	public function isAdmin(): bool
	{
		return $this->isAdmin;
	}
	
	/**
	 * @return string
	 */
	public function getCreatedOn(): string
	{
		return $this->createdOn;
	}
	
	/**
	 * @return int
	 */
	public function getCreatedBy(): int
	{
		return $this->createdBy;
	}
	
	/**
	 * @return bool
	 */
	public function isConfirmed(): bool
	{
		return $this->confirmed;
	}
	
	/**
	 * @return array
	 */
	public function toArray(): array
	{
		return [
			'id'        => $this->id,
			'accountId' => $this->accountId,
			'parentId'  => $this->parentId,
			'email'     => $this->email,
			'username'  => $this->username,
			'password'  => $this->password,
			'isAdmin'   => $this->isAdmin,
			'createdOn' => $this->createdOn,
			'createdBy' => $this->createdBy,
			'confirmed' => $this->confirmed,
		];
	}
	
}