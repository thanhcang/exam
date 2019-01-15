<?php

namespace Src\Repositories;

use Src\Models\MessageModel;

class MessageRepository extends BaseRepository
{
    protected $model = MessageModel::class;

    public function post(string $author, string $message): void
    {
        $sql = "INSERT INTO {$this->getModel()->getTable()} 
                (author, message, date_created, date_modified) 
                VALUES (:author, :message,:dateCreated,:dateModified)";

        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->bindValue(':author', $author);
        $stmt->bindValue(':message', $message);
        $stmt->bindValue(':dateCreated', date('Y-m-d H:i:s'));
        $stmt->bindValue(':dateModified', date('Y-m-d H:i:s'));

        $stmt->execute();
    }

    public function deleteById(int $id): void
    {
        $sql = "DELETE FROM {$this->getModel()->getTable()} where id = :ID";

        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->bindValue(':ID', $id);

        $stmt->execute();
    }

    public function edit(int $id, string $message)
    {
        $sql = "UPDATE {$this->getModel()->getTable()} SET message = :MESSAGE, date_modified = :dateModified
                WHERE id = :ID
              ";

        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->bindValue(':MESSAGE', $message);
        $stmt->bindValue(':dateModified', date('Y-m-d H:i:s'));
        $stmt->bindValue(':ID', $id);

        $stmt->execute();
    }
}