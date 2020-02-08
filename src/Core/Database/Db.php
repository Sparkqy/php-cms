<?php

namespace src\Core\Database;

use Exception;
use PDO;
use src\Core\Config\Config;
use src\Exceptions\DbException;

class Db
{
    /**
     * @var PDO
     */
    private PDO $pdo;

    /**
     * @var self
     */
    private static $instance;

    /**
     * DbConnection constructor.
     * @throws DbException
     */
    private function __construct()
    {
        $this->connect();
    }

    private function __clone() {}
    private function __wakeup() {}

    /**
     * @return void
     * @throws Exception
     * @throws DbException
     */
    private function connect(): void
    {
        try {
            $options = Config::file('db_options');

            $this->pdo = new PDO(
                'mysql:host=' . $options['host'] .
                ';dbname=' . $options['db_name'],
                $options['user'],
                $options['password'],
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new DbException('Database error occurred: ' . $e->getMessage());
        }
    }

    /**
     * @return $this
     * @throws DbException
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $query
     * @param array $params
     * @param bool $fetch
     * @return array|bool|null
     */
    public function querySql(string $query, $params = [], bool $fetch = true)
    {
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute($params);

        if ($result === false) {
            return null;
        }

        if (!$fetch) {
            return true;
        }

        $result = $sth->fetchAll(PDO::FETCH_ASSOC);

        return !empty($result) ? $result : null;
    }

    /**
     * @return string
     */
    public function lastInsertId(): string
    {
        return $this->pdo->lastInsertId();
    }
}