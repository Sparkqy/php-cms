<?php

namespace src\Services\Database;

use src\Core\Database\Db;
use src\Exceptions\DbException;
use src\Exceptions\DIContainerException;
use src\Services\AbstractProvider;

class DatabaseProvider extends AbstractProvider
{
    /**
     * @var string
     */
    const SERVICE_NAME = 'db';

    /**
     * @throws DIContainerException
     * @throws DbException
     */
    public function init(): void
    {
        $db = Db::getInstance();
        $this->di->set(self::SERVICE_NAME, $db);
    }
}