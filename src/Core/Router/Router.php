<?php

namespace src\Core\Router;

class Router
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var UrlDispatcher
     */
    private $dispatcher;

    /**
     * @var array
     */
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
     * @param string $name
     * @param string $pattern
     * @param string $controller
     * @param string $method
     * @return void
     */
    public function add(string $name, string $pattern, string $controller, string $method = 'GET'): void
    {
        $this->routes[$name] = [
            'pattern' => $pattern,
            'controller' => $controller,
            'method' => $method,
        ];
    }

    /**
     * @param string $method
     * @param string $url
     * @return DispatchedRoute|null
     */
    public function dispatch(string $method, string $url): ?DispatchedRoute
    {
        return $this->getDispatcher()->dispatch($method, $url);
    }

    /**
     * @return UrlDispatcher
     */
    public function getDispatcher(): UrlDispatcher
    {
        if (is_null($this->dispatcher)) {
            $this->dispatcher = new UrlDispatcher();

            foreach ($this->routes as $route) {
                $this->dispatcher->register($route['method'], $route['pattern'], $route['controller']);
            }
        }

        return $this->dispatcher;
    }
}