<?php

namespace Src\Repositories;

use PDO;
use Src\Library\Mysql;
use Src\Models\ModelInterFace;

class BaseRepository
{
    /**
     * @var Mysql
     */
    protected $mysql;

    /**
     * @var string
     */
    protected $model;

    public function __construct()
    {
        $this->mysql = Mysql::getInstance();
    }

    public function all()
    {
        $sql  = "select * from {$this->getModel()->getTable()}";
        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($value)
    {
        $sql  = "select * from {$this->getModel()->getTable()} where {$this->getModel()->getPrimary()} = :ID ";
        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->bindValue(':ID', $value);
        $stmt->execute();

        return $stmt->fetch();
    }

    protected function getModel(): ModelInterFace
    {
        return new $this->model;
    }

    public function lastInsertId()
    {
        return $this->mysql->getConnection()->lastInsertId();
    }

    public function transaction(): void
    {
        $this->mysql->getConnection()->beginTransaction();
    }

    public function commit()
    {
        $this->mysql->getConnection()->commit();
    }

    public function rollback()
    {
        $this->mysql->getConnection()->rollBack();
    }
}