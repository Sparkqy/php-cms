<?php

use src\Cms;
use src\DI\DI;
use src\Helpers\Url;
use src\Services\AbstractProvider;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/configs/error_display_options.php';

session_start();
define('ENV', Url::getEnvironment());

try {
    $di = new DI();

    $services = require __DIR__ . '/configs/services.php';

    foreach ($services as $service) {
        /** @var AbstractProvider $provider */
        $provider = new $service($di);
        $provider->init();
    }

    $cms = new Cms($di);
    $cms->run();
} catch (\src\Exceptions\DbException | Exception | \src\Exceptions\DIContainerException $e) {
    http_response_code(404);
    echo 'Fatal error: ' . $e->getMessage();
    exit();
}
