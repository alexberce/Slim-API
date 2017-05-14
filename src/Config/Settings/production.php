<?php
return [
    'settings' => [
	
	    'php-di' => [
		    'use_autowiring' => true,
		    'use_annotations' => false,
	    ],
    	
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
	        'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'API',
            'path' => __DIR__ . '../../../logs/app_' . date('Y-m-d').'.log',
            'level' => \Monolog\Logger::INFO,
        ],
        
        // Database settings
	    "db" => [
		    "host" => "HOST_HERE",
		    "dbName" => "DB_NAME_HERE",
		    "user" => "USERNAME_HERE",
		    "pass" => "PASSWORD_HERE"
	    ],
    ],
];