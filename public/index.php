<?php
use Invobox\Config\Settings\Settings;
use Jgut\Slim\PHPDI\ContainerBuilder;
use Slim\App;

if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}

require __DIR__ . '/../vendor/autoload.php';

/** @noinspection PhpIncludeInspection */
$settings     = require Settings::getApplicationSettingsFile();
$dependencies = require __DIR__ . '/../src/Config/dependencies.php';

$container = ContainerBuilder::build($settings, $dependencies);

require __DIR__ . '/../src/Config/handlers.php';

$app = new App($container);

// Register middleware
require __DIR__ . '/../src/Config/middleware.php';

// Register routes
require __DIR__ . '/../src/Config/routes.php';

// Run app
$app->run();
