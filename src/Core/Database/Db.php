<?php

namespace src\Core\Database;

use PDO;
use src\Exceptions\DbException;

class Db
{
    /**
     * @var PDO
     */
    private $pdo;

    private static $instance;

    /**
     * DbConnection constructor.
     * @throws DbException
     */
    private function __construct()
    {
        $this->connect();
    }

    /**
     * @throws DbException
     */
    private function connect()
    {
        try {
            $options = require_once __DIR__. '/../../Config/db_options.php';

            $this->pdo = new PDO(
                'mysql:host=' . $options['host'] . ';dbname=' . $options['db_name'],
                $options['user'],
                $options['password'],
            );

            $this->pdo->exec('SET NAMES UTF8');
        } catch (\PDOException $e) {
            throw new DbException('Database connection error occurred: ' . $e->getMessage());
        }
    }

    /**
     * @return $this
     * @throws DbException
     */
    public static function instance(): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $query
     * @param array $params
     * @return array|null
     */
    public function query(string $query, $params = []): ?array
    {
        $sth = $this->pdo->prepare($query);
        $result = $sth->execute($params);

        if ($result === false) {
            return null;
        }

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}