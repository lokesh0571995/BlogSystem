<?php

namespace Core;

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        $config = require_once __DIR__ . '/../../config/config.php';

        $host = $config['DB_HOST'];
        $dbname = $config['DB_NAME'];
        $user = $config['DB_USER'];
        $password = $config['DB_PASSWORD'];

        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

        try {
            $this->pdo = new \PDO($dsn, $user, $password);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die(json_encode(['error' => 'Internal Server Error']));
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->pdo;
    }
}
