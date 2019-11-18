<?php

namespace src\Core\Router;

class DispatchedRoute
{
    /**
     * @var string
     */
    private $controller;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(string $controller, $parameters = [])
    {
        $this->controller = $controller;
        $this->parameters = $parameters;
    }

    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }

    /**
     * @return array
     */
    public function getParameters(): array
    {
        return $this->parameters;
    }
}