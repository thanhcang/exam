<?php

namespace Src\Library;

use mysqli;
use PDO;
use PDOException;
use Src\Exception\MysqlException;
use Src\Exception\ProjectConfigurationException;

class Mysql
{
    /**
     * @var self
     */
    private static $instance;
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var PDO
     */
    private $connection;

    /**
     * @var bool
     */
    private $connected = true;

    public function __construct()
    {
        try {
            $env            = ProjectConfiguration::getInstance();
            $this->host     = $env->get('DB_HOST');
            $this->database = $env->get('DB_DATABASE');
            $this->username = $env->get('DB_USERNAME');
            $this->password = $env->get('DB_PASSWORD');
            $this->open();
        } catch (ProjectConfigurationException $exception) {
            throw new MysqlException($exception->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof ProjectConfiguration) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    protected function open(): void
    {
        try {
            $mysql = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->setConnection($mysql);
            $this->connected = true;
        } catch (PDOException $e) {
            throw new MysqlException('connection DB is error, please check your env file');
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    private function setConnection(PDO $connection)
    {
        $this->connection = $connection;
    }
}
