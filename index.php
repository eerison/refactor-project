<?php
declare(strict_types=1);

require_once __DIR__ . "/vendor/autoload.php";

$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

require_once __DIR__ . "/config/services.php";
require_once __DIR__ . "/config/routers.php";