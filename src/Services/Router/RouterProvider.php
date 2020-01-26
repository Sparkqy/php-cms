<?php

namespace src\Services\Router;

use src\Core\Router\Router;
use src\Exceptions\DIContainerException;
use src\Services\AbstractProvider;

class RouterProvider extends AbstractProvider
{
    /**
     * @var string
     */
    const SERVICE_NAME = 'router';

    /**
     * @throws DIContainerException
     */
    public function init(): void
    {
        $router = new Router('http://php-cms.loc');
        $this->di->set(self::SERVICE_NAME, $router);
    }
}