<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__ . '/..', 'app.env');
$dotenv->load();

$dotenv->required(['YII_ENV', 'YII_DEBUG', 'YII_TRACE_LEVEL']);
$dotenv->required(['APP_NAME', 'APP_VERSION', 'APP_SUPPORT_EMAIL', 'APP_ADMIN_EMAIL', 'APP_LOCALE', 'APP_TIMEZONE', 'APP_COOKIE_VALIDATION_KEY', 'APP_SWITCH_IDENTITY_SESSION_KEY']);
$dotenv->required(['DB_TYPE', 'DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USERNAME', 'DB_PASSWORD']);
$dotenv->required(['REDIS_HOST', 'REDIS_PORT']);
