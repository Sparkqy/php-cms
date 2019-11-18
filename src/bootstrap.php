<?php

use src\Cms;
use src\DI\DI;
use src\Services\AbstractProvider;

require_once __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/Config/error_display_options.php';

try {
    $di = new DI();

    $services = require __DIR__ . '/Config/services.php';

    foreach ($services as $service) {
        /** @var AbstractProvider $provider */
        $provider = new $service($di);
        $provider->init();
    }

    $cms = new Cms($di);
    $cms->run();
} catch (\src\Exceptions\DbException $e) {
    echo $e->getMessage();
    exit();
}
