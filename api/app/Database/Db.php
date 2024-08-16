<?php
declare(strict_types=1);

namespace App\Database;

class Db
{
    private \PDO  $conn;
    private static ?Db $instance = null;

    private function __construct()
    {
        $host = $_ENV['DB_HOSTNAME'];
        $user = $_ENV['DB_USERNAME'];
        $db = $_ENV['DB_NAME'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            $this->conn = new \PDO("mysql:host=$host;dbname=$db", $user, $password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            http_response_code(500);
            die('DB connection error ' . $e->getMessage() . '<br />');
        }
    }

    public static function getConnection(): \PDO
    {
        if (!self::$instance) {
            self::$instance = new Db();
        }
        return self::$instance->conn;
    }
}