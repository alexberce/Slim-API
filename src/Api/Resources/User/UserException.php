<?php


namespace Invobox\Api\Resources\User;


class UserException extends \Exception
{
	const EXCEPTION_CLASS = 1;
	
	const INVALID_ARGUMENTS               = 1;
	const INVALID_ARGUMENT_USER_ID        = 2;
	const INVALID_ARGUMENT_USERNAME       = 3;
	const INVALID_ARGUMENT_PASSWORD       = 4;
	const INVALID_ARGUMENT_PASSWORD_MATCH = 5;
	const INVALID_ARGUMENT_EMAIL          = 6;
	const INVALID_ARGUMENT_ADMIN          = 7;
}