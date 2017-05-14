<?php


namespace Invobox\Api\Response;


class ResponseErrorMessages
{
	const NOT_FOUND = 'Resource not found';
	const ACCESS_DENIED = 'Access denied';
	const UNKNOWN_ERROR = 'Unknown Error';
	const METHOD_NOT_ALLOWED = 'Invalid method. Must be of type: %s';
	const INTERNAL_SERVER_ERROR = 'Internal server error. Our engineers have been notified!';
}