<?php

require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Include the routing configuration
$route = require __DIR__ . '/src/Config/routing.php';

// Execute the routing logic
$route();
