<?php

namespace Src\Repositories;

use Src\Models\MessageHistoryModel;

class MessageHistoryRepository extends BaseRepository
{
    protected $model = MessageHistoryModel::class;

    public function post(int $messageId, string $message)
    {
        $sql = "INSERT INTO {$this->getModel()->getTable()} 
                (message_id, message, date_modified) 
                VALUES (:messageId, :message,:dateModified)";

        $stmt = $this->mysql->getConnection()->prepare($sql);
        $stmt->bindValue(':messageId', $messageId);
        $stmt->bindValue(':message', $message);
        $stmt->bindValue(':dateCreated', date('Y-m-d H:i:s'));

        $stmt->execute();
    }
}