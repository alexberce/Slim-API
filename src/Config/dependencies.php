<?php
use Interop\Container\ContainerInterface;
use Invobox\Api\Database\Database;
use Invobox\Api\Logger\Logger;
use Invobox\Api\Logger\LoggerInterface;
use Invobox\Api\UserContext\UserContextInterface;
use Invobox\Api\UserContext\UserContext;

return [
	UserContextInterface::class => function (ContainerInterface $container) {
		$userContext = $container->get(UserContext::class);
		$userContext->setJwt($container->get('jwt'));
		
		return $userContext;
	},
	
	LoggerInterface::class => function (ContainerInterface $container) {
		$settings = $container->get('settings')['logger'];
		$logger   = new Logger($settings['name']);
		$logger->pushProcessor(new Monolog\Processor\UidProcessor());
		$logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
		
		return $logger;
	},
	
	Database::class        => function (ContainerInterface $container) {
		$settings = $container->get('settings')['db'];
		$pdo      = new Database(
			"mysql:host=" . $settings['host'] . ";dbname=" . $settings['dbName'],
			$settings['user'],
			$settings['pass']
		);
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		
		return $pdo;
	},
	
	'logger'               => function (ContainerInterface $container) {
		return $container->get(LoggerInterface::class);
	},
	
	'db'                   => function (ContainerInterface $container) {
		return $container->get(Database::class);
	},
    
    'jwt' => '',
];
