<?php
/**
 * PreFlight Request CORS
 */
$app->add(function ($req, $res, $next) {
	$response = $next($req, $res);
	
	/** @noinspection PhpUndefinedMethodInspection */
	return $response
		->withHeader('Access-Control-Allow-Origin', '*')
		->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
		->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
		->withHeader('Allow', 'GET, POST, PUT, DELETE, OPTIONS')
		->withHeader('Content-Type', 'application/json; charset=UTF-8');
});

// Routes
$app->group('/v1', function () use ($app) {
	
	$app->group('/users', function () use ($app) {
		
		$app->get('/me', '\Invobox\Api\Resources\User\UserController:me');
		$app->get('[/{id}]', '\Invobox\Api\Resources\User\UserController:get');
		$app->post('[/]', '\Invobox\Api\Resources\User\UserController:create');
		$app->put('/:id', '\Invobox\Api\Resources\User\UserController:update');
		$app->delete('/:id', '\Invobox\Api\Resources\User\UserController:delete');
		
	});
	
	$app->group('/token', function () use ($app) {
		
		$app->post('[/]', '\Invobox\Api\Authentication\AuthenticationController:createToken');
		$app->put('/refresh', '\Invobox\Api\Authentication\AuthenticationController:refreshToken');
		$app->delete('/invalidate', '\Invobox\Api\Authentication\AuthenticationController:invalidateToken');
		
	});
	
});

$app->options('/{routes:.+}', function ($request, $response, $args) {
	return $response;
});


