<?php

namespace src\Core\Database;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use src\Exceptions\DIContainerException;

trait ActiveRecord
{
    /**
     * @var Db
     */
    protected $db;

    /**
     * @var QueryBuilder
     */
    protected $queryBuilder;

    /**
     * ActiveRecord constructor.
     * @param int $id
     * @throws DIContainerException
     */
    public function __construct(int $id = 0)
    {
        global $di;
        $this->db = $di->get('db');
        $this->queryBuilder = $di->get('query_builder');

        if ($id) {
            $this->id = $id;
        }
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @throws ReflectionException
     */
    public function save(): void
    {
        $properties = $this->getIssetProperties();

        try {
            if (isset($this->id)) {
                $queryBuilder = $this->queryBuilder
                    ->update($this->getTable())
                    ->set($properties)
                    ->where('id', $this->id);
                $this->db->querySql($queryBuilder->sql(), $queryBuilder->getValues()['set'], false);
            } else {
                $queryBuilder = $this->queryBuilder->insert($this->getTable())->set($properties);
                $this->db->querySql($queryBuilder->sql(), $queryBuilder->getValues()['set'], false);
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    private function getIssetProperties(): array
    {
        $properties = [];

        foreach ($this->getProperties() as $key => $property) {
            if (isset($this->{$property->getName()})) {
                $properties[$property->getName()] = $this->{$property->getName()};
            }
        }

        return $properties;
    }

    /**
     * @return ReflectionProperty[]
     * @throws ReflectionException
     */
    private function getProperties()
    {
        $reflection = new ReflectionClass($this);

        return $reflection->getProperties(ReflectionProperty::IS_PUBLIC);
    }
}