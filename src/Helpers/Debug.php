<?php

namespace src\Helpers;

class Debug
{
    /**
     * @param $data
     */
    public static function dd($data)
    {
        echo '<pre style="background: #d0e9c6; font-size: 14px;">';
        var_dump($data);
        echo '</pre>';
        exit();
    }
}