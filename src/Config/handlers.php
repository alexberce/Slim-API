<?php

use Interop\Container\ContainerInterface;
use Invobox\Api\Utils\Environment;

$container['notAllowedHandler'] = function (ContainerInterface $container) {
	return new Invobox\Api\Handlers\NotAllowedHandler($container['logger']);
};

$container['notFoundHandler'] = function ($container) {
	return new Invobox\Api\Handlers\NotFoundHandler($container['logger']);
};

if(Environment::isProduction()){
	$container['phpErrorHandler'] = function ($container) {
		return new Invobox\Api\Handlers\PhpErrorHandler($container['logger']);
	};
	
	$container['errorHandler'] = function ($container) {
		return new Invobox\Api\Handlers\ErrorHandler($container['logger']);
	};
}