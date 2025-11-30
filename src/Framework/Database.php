<?php

declare(strict_types=1);

namespace Framework;

use PDO, PDOException;
use PDOStatement;

class Database
{
    private PDO $conn;
    private PDOStatement $stmt;

    public function __construct(
        string $driver,
        string $host,
        string $port,
        string $dbname,
        string $username,
        string $password
    ) {
        try {

            $this->conn = new PDO("$driver:host=$host;port=$port;dbname=$dbname", $username, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // إعدادات إضافية للتعامل مع الأخطاء
        } catch (PDOException $e) {
            die("Unable to connect to database: " . $e->getMessage());
        }
    }


    public function query(string $query, array $params = []): Database
    {
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($params);
        return $this;
    }


    public function count(): int
    {
        return $this->stmt->fetchColumn();
    }
    public function find(): array|false
    {
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function id()
    {
        return $this->conn->lastInsertId();
    }
}
