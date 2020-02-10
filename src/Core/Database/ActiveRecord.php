<?php

namespace src\Core\Database;

use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use src\DI\DI;
use src\Exceptions\DIContainerException;

abstract class ActiveRecord
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
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        $this->db = $di->get('db');
        $this->queryBuilder = $di->get('query_builder');
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        return $this->table;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function setId(int $id): self
    {
        if ($id < 0) {
            throw new \InvalidArgumentException('Id column value cannot equal less than zero');
        }

        $this->id = $id ? $id : null;

        return $this;
    }

    /**
     * @return array|null
     */
    public function findOne(): ?array
    {
        $queryBuilder = $this->queryBuilder->select()
            ->from($this->getTable())
            ->where('id', $this->id);

        $result = $this->db->querySql($queryBuilder->sql(), $queryBuilder->getValues('where'));

        return isset($result[0]) ? $result[0] : null;
    }

    /**
     * @throws ReflectionException
     */
    public function save(): string
    {
        $properties = $this->getIssetProperties();

        try {
            if (isset($this->id)) {
                $queryBuilder = $this->queryBuilder->update($this->getTable())
                    ->set($properties)
                    ->where('id', $this->id);
                $this->db->querySql($queryBuilder->sql(), $queryBuilder->getValues()['set'], false);
            } else {
                $queryBuilder = $this->queryBuilder->insert($this->getTable())->set($properties);
                $this->db->querySql($queryBuilder->sql(), $queryBuilder->getValues()['set'], false);
            }

            return $this->db->lastInsertId();
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