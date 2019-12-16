<?php

namespace src;

use src\Core\Router\DispatchedRoute;
use src\Core\Router\Router;
use src\DI\DI;
use src\Exceptions\DIContainerException;
use src\Helpers\Url;
use src\Services\Router\RouterProvider;

class Cms
{
    /**
     * @var DI
     */
    private $di;

    /**
     * @var Router
     */
    public $router;

    /**
     * App constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->router = $this->di->get(RouterProvider::SERVICE_NAME);
    }

    /**
     * Run application
     */
    public function run()
    {
        try {
            require_once __DIR__ . '/../' . ENV . '/routes.php';

            $dispatchedRoute = $this->router->dispatch(Url::getRequestMethod(), Url::getUrl());

            if (is_null($dispatchedRoute)) {
                $dispatchedRoute = new DispatchedRoute('ErrorsController@show404');
            }

            list($class, $action) = explode('@', $dispatchedRoute->getController(), 2);
            $controller = ENV . '\\Controllers\\' . $class;
            $parameters = $dispatchedRoute->getParameters();

            call_user_func_array([new $controller($this->di), $action], $parameters);
        } catch (\Exception | DIContainerException $e) {
            http_response_code(404);
            echo 'Fatal error: ' . $e->getMessage();
            exit();
        }
    }
}