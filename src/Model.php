<?php

namespace src;

use src\Core\Database\Db;
use src\Core\Database\QueryBuilder;
use src\DI\DI;

abstract class Model
{
    /**
     * @var DI
     */
    protected DI $di;

    /**
     * @var Db
     */
    protected Db $db;

    /**
     * @var array
     */
    protected array $configs;

    /**
     * @var QueryBuilder
     */
    protected QueryBuilder $queryBuilder;

    /**
     * @var Load
     */
    protected Load $loader;

    /**
     * Model constructor.
     * @param DI $di
     * @throws Exceptions\DIContainerException
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->configs = $this->di->get('config');
        $this->queryBuilder = $this->di->get('query_builder');
        $this->loader = $this->di->get('loader');
    }
}