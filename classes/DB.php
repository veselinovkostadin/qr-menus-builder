<?php

namespace Classes;

require_once __DIR__ . "/../consts.php";


use Classes\User;

class DB
{
    protected static $conn = null;
    private static $pdo;

    public static function connect()
    {
        if (is_null(self::$conn)) {
            try {
                self::$pdo = new \PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";", DB_USER, DB_PASS);
            } catch (\PDOException $e) {
                die("Database down.");
            }
        }

        return self::$pdo;
    }
}
