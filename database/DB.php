<?php
/*
* Mysql database class - only one connection allowed
*/

declare(strict_types=1);

require_once $_SERVER['DOCUMENT_ROOT'] . './config/database.php';

final class DB
{
    private PDO $connection;
    private static self|null $instance = null;

    // Constructor
    public function __construct(
        private string $db_host = DB_SERVER, // Ip Address of database if external connection.
        private string $db_name = DB_NAME, // Username for DB
        private string $db_user = DB_USERNAME, // DB Name
        private string $db_password = DB_PASSWORD // Password for DB
    ) {
        try {
             $this->connection = new PDO(
                'mysql:host=' . $this->db_host . ';dbname=' . $this->db_name,
                $this->db_user,
                $this->db_password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        // Error handling
        } catch (PDOException $e) {
            die("Failed to connect to DB: ". $e->getMessage()." ".(int) $e->getCode());
        }
    }

    /*
      Get an instance of the Database
      @return Instance
      */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    // Get the connection
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    // Close connection
    public static function closeInstance() {
        return self::$instance = null;
    }

    public function __call ( $method, $args ) {
        if ( is_callable(array($this->connection, $method)) ) {
            return call_user_func_array(array($this->connection, $method), $args);
        }
        else {
            throw new BadMethodCallException('Undefined method Database::' . $method);
        }
    }

    // Magic method clone is empty to prevent duplication of connection
    public function __clone(): void{}

    // Magic method wakeup is empty to prevent initialize the value whenever we get a new fresh instance from the unserialize function
    public function __wakeup(): void{}
}




