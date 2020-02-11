<?php

namespace src\Core\Config;

class Config
{
    /**
     * @var array
     */
    const CONFIG_PATHS = [
        'admin' => __DIR__ . '/../../../admin/configs',
        'cms' => __DIR__ . '/../../../cms/configs',
        'src' => __DIR__ . '/../../configs',
    ];

    /**
     * @param string $key
     * @param string $group
     * @return bool|mixed
     * @throws \Exception
     */
    public static function item(string $key, string $group = 'main')
    {
        $groupItems = self::file($group);

        return isset($groupItems[$key]) ? $groupItems[$key] : false;
    }

    /**
     * @param string $group
     * @return array|null
     * @throws \Exception
     */
    public static function file(string $group)
    {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/../' . strtolower(ENV) . '/configs/' . $group . '.php';

        if (!file_exists($path)) {
            return null;
        }

        $data = require $path;

        if (!is_array($data) && $data !== true) {
            throw new \Exception(sprintf('Config file %s is not valid. File must return an array of data', $path));
        }

        return $data;
    }
}