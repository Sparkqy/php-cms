<?php

namespace src;

use src\Core\Router\Router;
use src\DI\DI;
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
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->router = $this->di->get(RouterProvider::$serviceName);
    }

    /**
     * Run application
     */
    public function run()
    {
//        $this->router->add('home', '/home', 'HomeController', 'index');
        echo '<pre>';
        print_r($this->di);
        echo '</pre>';
    }
}