<?php

namespace src\Core\Database;

class QueryBuilder
{
    /**
     * @var array
     */
    protected $sql = [];

    /**
     * @var array
     */
    protected $values = [];

    /**
     * @param string $fields
     * @return QueryBuilder
     */
    public function select(string $fields = '*'): self
    {
        $this->reset();

        if ($fields !== '*') {
            $fieldsChunks = explode(',', $fields);
            foreach ($fieldsChunks as &$chunk) {
                $chunk = "`$chunk`";
            }
            $fields = implode(',', $fieldsChunks);
        }

        $this->sql['select'] = "SELECT $fields ";

        return $this;
    }

    /**
     * @param string $table
     * @return QueryBuilder
     */
    public function from(string $table): self
    {
        $this->sql['from'] = "FROM `$table`";

        return $this;
    }

    /**
     * @param string $column
     * @param string $value
     * @param string $operator
     * @return QueryBuilder
     */
    public function where(string $column, string $value, string $operator = '='): self
    {
        $columnSql = "`$column`";
        $this->sql['where'][$columnSql] = " $operator :$column";
        $this->values['where'][$column] = $value;

        return $this;
    }

    /**
     * @param string $field
     * @param string $order
     * @return QueryBuilder
     */
    public function orderBy(string $field, string $order = 'ASC'): self
    {
        $order = strtoupper($order);
        $this->sql['order_by'] = "ORDER BY `$field` $order";

        return $this;
    }

    /**
     * @param int $number
     * @return $this
     */
    public function limit(int $number): self
    {
        $this->sql['limit'] = " LIMIT {$number}";

        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function update(string $table): self
    {
        $this->reset();
        $this->sql['update'] = "UPDATE $table ";

        return $this;
    }

    /**
     * @param string $table
     * @return $this
     */
    public function insert(string $table): self
    {
        $this->reset();
        $this->sql['insert'] = "INSERT INTO $table ";

        return $this;
    }

    /**
     * @param array $data
     * @return $this
     */
    public function set(array $data = [])
    {
        $this->sql['set'] = "SET ";

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if (count($data) > 1 && next($data)) {
                    $this->sql['set'] .= "`$key` = :$key, ";
                } else {
                    $this->sql['set'] .= "`$key` = :$key";
                }
                $this->values['set'][$key] = $value;
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function sql(): string
    {
        $sql = '';

        if (!empty($this->sql)) {
            foreach ($this->sql as $key => $sqlChunk) {
                if ($key === 'where') {
                    $sql .= ' WHERE ';
                    foreach ($this->sql['where'] as $field => $value) {
                        $sql .= $field . $value;
                        if (count($this->values['where']) > 1 && next($this->values['where'])) {
                            $sql .= ' AND ';
                        }
                    }
                } else {
                    $sql .= $sqlChunk;
                }
            }
        }

        return $sql;
    }

    private function reset(): void
    {
        $this->sql = [];
        $this->values = [];
    }

    /**
     * @param string|null $key
     * @return array
     */
    public function getValues(string $key = null): array
    {
        if ($key !== null) {
            return isset($this->values[$key]) ? $this->values[$key] : null;
        }

        return $this->values;
    }

    /**
     * @return array
     */
    public function getValuesMerged(): array
    {
        $valuesMerged = [];

        foreach ($this->values as $values) {
            foreach ($values as $key => $value) {
                $valuesMerged[$key] = $value;
            }
        }

        return $valuesMerged;
    }
}