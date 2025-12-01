<?php

namespace oop;
use PDO;
use PDOException;

class Dbh
{
    private array $config = [];
    private ?PDO $pdo = null; // Holds the PDO connection object

    public function __construct()
    {
        $this->config = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/configs.ini', true)['db'];
    }

    public function connect(): PDO
    {
        // If we're already connected, just return the existing connection.
        if ($this->pdo !== null) {
            return $this->pdo;
        }

        // --- Build the DSN (Data Source Name) ---
        $dsn = sprintf(
            "mysql:host=%s;port=%d;dbname=%s",
            $this->config['host'],
            $this->config['port'],
            $this->config['dbname'],
//            $this->config['charset'] ?? 'utf8mb4'
        );

        // --- Set secure PDO options ---
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Best way to handle errors
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,     // Returns arrays, not objects
            PDO::ATTR_EMULATE_PREPARES   => false,                  // Uses real prepared statements
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8mb4' COLLATE 'utf8mb4_unicode_ci'",
        ];

        try {
            // --- Create the connection ---
            $this->pdo = new PDO(
                $dsn,
                $this->config['username'],
                $this->config['password'],
                $options
            );

            return $this->pdo;

        } catch (PDOException $e) {
            // Never echo the error in production!
            // Log it instead.
            error_log("DB Connection Failed: " . $e->getMessage());
            // Show a generic error to the user
            throw new \PDOException("Could not connect to the database.", (int)$e->getCode());
        }
    }


}