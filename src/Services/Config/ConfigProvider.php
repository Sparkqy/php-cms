<?php

namespace src\Services\Config;

use Exception;
use src\Core\Config\Config;
use src\Services\AbstractProvider;

class ConfigProvider extends AbstractProvider
{
    /**
     * @var array
     */
    private $configs = [];

    /**
     * @var string
     */
    const SERVICE_NAME = 'config';

    /**
     * @throws Exception
     */
    public function init(): void
    {
        $this->configs['main'] = Config::file('main');
        $this->configs['db_options'] = Config::file('db_options');
        $this->di->set(self::SERVICE_NAME, $this->configs);
    }
}