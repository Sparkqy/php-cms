<?php

namespace src;

use src\DI\DI;
use stdClass;

class Load
{
    const MODEL_ENTITY_MASK = '\%s\Models\%s\%s';
    const MODEL_REPOSITORY_MASK = '\%s\Models\%s\%sRepository';

    /**
     * @var DI
     */
    protected DI $di;

    /**
     * Load constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    /**
     * @param string $modelName
     * @param bool $modelDir
     * @return stdClass
     */
    public function model(string $modelName, $modelDir = false): stdClass
    {
        $modelName = ucfirst($modelName);
        $model = new stdClass();
        $modelDir = $modelDir ? $modelDir : $modelName;

        $namespaceEntity = sprintf(self::MODEL_ENTITY_MASK, ENV, $modelDir, $modelName);
        $namespaceRepository = sprintf(self::MODEL_REPOSITORY_MASK, ENV, $modelDir, $modelName);

        $model->model = new $namespaceEntity($this->di);
        $model->repository = new $namespaceRepository($this->di);

        return $model;
    }
}