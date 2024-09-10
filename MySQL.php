<?php

class MySQL
{
    public static mysqli $connection;
    private static string $host = '127.0.0.1';
    private static string $username = 'root';
    private static string $password = 'password';
    private static string $database = 'greenway';
    private static string $port = '3306';

    private static function setUpConnection(): void
    {
        if (!isset(self::$connection)) {
            self::$connection = new mysqli(self::$host, self::$username, self::$password, self::$database, self::$port);
        }
    }

    public static function iud($query): bool
    {
        self::setUpConnection();
        return self::$connection->query($query);
    }

    public static function search($query): mysqli_result|bool
    {
        self::setUpConnection();
        return self::$connection->query($query);
    }
}