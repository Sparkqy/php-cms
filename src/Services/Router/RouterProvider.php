<?php

namespace src\Services\Router;

use src\Core\Router\Router;
use src\Services\AbstractProvider;

class RouterProvider extends AbstractProvider
{
    public static $serviceName = 'router';

    public function init(): void
    {
        $router = new Router('http://php-cms.loc');

        $this->di->set(self::$serviceName, $router);
    }
}