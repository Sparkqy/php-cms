<?php

namespace src\Core\Router;

class UrlDispatcher
{
    /**
     * @var array
     */
    const METHODS = [
        'get' => 'GET',
        'post' => 'POST',
    ];

    /**
     * @var array
     */
    private $routes = [
        self::METHODS['get'] => [],
        self::METHODS['post'] => [],
    ];

    /**
     * @var array
     */
    private $patterns = [
        'int' => '[0-9]+',
        'string' => '[a-zA-Z\.\-_%]+',
        'any' => '[a-zA-Z0-9\.\-_%]+',
    ];

    /**
     * @param string $key
     * @param string $pattern
     */
    public function addPattern(string $key, string $pattern): void
    {
        $this->patterns[$key] = $pattern;
    }

    /**
     * @param string $method
     * @return array|null
     */
    private function getRoutesByMethod(string $method): ?array
    {
        if (!array_key_exists($method, $this->routes)) {
            return null;
        }

        return $this->routes[$method];
    }

    /**
     * @param string $method
     * @param string $pattern
     * @param string $controller
     * @return void
     */
    public function register(string $method, string $pattern, string $controller): void
    {
        $convertedPattern = $this->convertPattern($pattern);
        $this->routes[strtoupper($method)][$convertedPattern] = $controller;
    }

    /**
     * @param string $pattern
     * @return string|string[]|null
     */
    private function convertPattern(string $pattern)
    {
        if (!strpos($pattern, '(')) {
            return $pattern;
        }

        return preg_replace_callback('#\\((\w+):(\w+)\\)#', function (array $matches) {
            return '(?<' . $matches[1] . '>' . strtr($matches[2], $this->patterns) . ')';
        }, $pattern);
    }

    /**
     * @param array $parameters
     * @return array
     */
    private function processParam(array $parameters): array
    {
        foreach ($parameters as $key => $param) {
            if (is_int($key)) unset($parameters[$key]);
        }

        return $parameters;
    }

    /**
     * @param string $method
     * @param string $url
     * @return DispatchedRoute|null
     */
    public function dispatch(string $method, string $url): ?DispatchedRoute
    {
        $routes = $this->getRoutesByMethod(strtoupper($method));

        if (array_key_exists($url, $routes)) {
            return new DispatchedRoute($routes[$url]);
        }

        return $this->doDispatch($method, $url);
    }

    /**
     * @param string $method
     * @param string $url
     * @return DispatchedRoute|null
     */
    private function doDispatch(string $method, string $url): ?DispatchedRoute
    {
        foreach ($this->getRoutesByMethod($method) as $route => $controller) {
            $pattern = '#^' . $route . '$#';

            if (preg_match($pattern, $url, $parameters)) {
                return new DispatchedRoute($controller, $this->processParam($parameters));
            }
        }

        return null;
    }
}