<?php
// Application middleware
use Invobox\Api\Response\ResponseErrorCodes;
use Invobox\Api\Utils\Environment;

$app->add(
	new \Slim\Middleware\JwtAuthentication(
		[
			"secret"    => 'SECRET_HERE',
			"relaxed" => Environment::$developmentDomains,
			"algorithm" => "HS256",
			"header" => "X-Token",
			"rules"     => [
				new \Slim\Middleware\JwtAuthentication\RequestPathRule(
					[
						"path"        => "/",
						"passthrough" => ['/v1/token'],
					]
				),
				new \Slim\Middleware\JwtAuthentication\RequestMethodRule(
					[
						"passthrough" => ["OPTIONS"],
					]
				),
				new \Slim\Middleware\JwtAuthentication\RequestMethodRule(
					[
						"passthrough" => ["POST"],
					    "path" => "/v1/users"
					]
				),
				new \Slim\Middleware\JwtAuthentication\RequestMethodRule(
					[
						"passthrough" => ["POST"],
						"path" => "/v1/account"
					]
				)
			],
			"callback"  => function ($request, $response, $arguments) use ($container) {
				$container["jwt"] = $arguments["decoded"];
			},
			"error"     => function ($request, $response, $arguments) {
				(new Invobox\Api\Response\ResponseService())
					->withErrorMessage($arguments["message"])
					->withStatusCode(401)
					->withErrorCode(ResponseErrorCodes::RESPONSE_CODE_UNAUTHORIZED)
					->write();
			},
		]
	)
);