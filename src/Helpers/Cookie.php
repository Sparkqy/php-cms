<?php

namespace src\Helpers;

class Cookie
{
    /**
     * @param string $key
     * @param string $value
     * @param int $time
     * @return void
     */
    public static function set(string $key, string $value, $time = 31536000): void
    {
        setcookie($key, $value, time() + $time, '/');
    }

    /**
     * @param string $key
     * @return string|null
     */
    public static function get(string $key): ?string
    {
        return $_COOKIE[$key] ?? null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public static function unset(string $key): bool
    {
        if (!isset($_COOKIE[$key])) {
            return false;
        }

        self::set($key, '', time() - 3600);
        unset($_COOKIE[$key]);

        return true;
    }
}