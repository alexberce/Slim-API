<?php


namespace Invobox\Api\UserContext;


interface UserContextInterface
{
	/**
	 * @return int
	 */
	public function getId();
	
	/**
	 * @return int
	 */
	public function getAccountId();
	
	/**
	 * @return int
	 */
	public function getParentId();
	
	/**
	 * @return bool
	 */
	public function isAdmin();
}