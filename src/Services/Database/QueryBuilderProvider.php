<?php

namespace src\Services\Database;

use src\Core\Database\QueryBuilder;
use src\Exceptions\DIContainerException;
use src\Services\AbstractProvider;

class QueryBuilderProvider extends AbstractProvider
{
    /**
     * @var string
     */
    const SERVICE_NAME = 'query_builder';

    /**
     * @throws DIContainerException
     */
    public function init(): void
    {
        $queryBuilder = new QueryBuilder();
        $this->di->set(self::SERVICE_NAME, $queryBuilder);
    }
}