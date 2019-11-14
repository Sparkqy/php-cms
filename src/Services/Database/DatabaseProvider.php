<?php

namespace src\Services\Database;

use src\Core\Database\Db;
use src\Services\AbstractProvider;

class DatabaseProvider extends AbstractProvider
{
    /**
     * @var string
     */
    public static $serviceName = 'db';

    /**
     * @throws \src\Exceptions\DbException
     */
    public function init(): void
    {
        $db = Db::instance();

        $this->di->set(self::$serviceName, $db);
    }
}