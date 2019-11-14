<?php

namespace src\Core\Router;

class Router
{
    private $host;

    private $dispatcher;

    private $routes = [];

    /**
     * Router constructor.
     * @param string $host
     */
    public function __construct(string $host)
    {
        $this->host = $host;
    }

    /**
     * @param string $key
     * @param string $pattern
     * @param string $controller
     * @param string $action
     * @param string $method
     * @return void
     */
    public function add(string $key, string $pattern, string $controller, string $action, string $method = 'GET'): void
    {
        $this->routes[$key] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'action' => $action,
            'method' => $method,
        ];
    }
}