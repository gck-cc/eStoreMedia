<?php

declare(strict_types = 1);

use Core\Service\ServiceFactory;
use Symfony\Component\Dotenv\Dotenv;
use Monolog\Handler\StreamHandler;
use Monolog\ErrorHandler;
use Monolog\Logger;

require_once 'vendor/autoload.php';

$env = new Dotenv(true);
$env->load(__DIR__ . '/.env');

$logger = new Logger('main');
$logger->pushHandler(new StreamHandler('log/error.log', Logger::WARNING));
ErrorHandler::register($logger);

$task = ServiceFactory::create();
$task->run(__DIR__ . DIRECTORY_SEPARATOR . getenv('OUTPUT_PATH') . DIRECTORY_SEPARATOR . getenv('OUTPUT_FILE'));
