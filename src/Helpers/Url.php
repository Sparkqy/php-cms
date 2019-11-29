<?php

namespace src\Helpers;

use src\Core\Router\Router;

class Url
{
    /**
     * @return bool
     */
    public static function isPost(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] === 'POST') ? true : false;
    }

    /**
     * @return bool
     */
    public static function isGet(): bool
    {
        return ($_SERVER['REQUEST_METHOD'] === 'GET') ? true : false;
    }

    /**
     * @return string
     */
    public static function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public static function getUrl(): string
    {
        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');

        return ($position) ? substr($url, 0, $position) : $url;
    }

    /**
     * @return string
     */
    public static function getEnvironment(): string
    {
        $env = explode('/', $_SERVER['REQUEST_URI']);

        return ($env[1] === 'admin') ? 'admin' : 'cms';
    }
}