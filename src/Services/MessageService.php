<?php

namespace Src\Services;


use PDOException;
use Src\Models\MessageModel;
use Src\Repositories\MessageHistoryRepository;
use Src\Repositories\MessageRepository;

class MessageService
{
    private $messageRepository;

    private $messageHistoryRepository;

    public function __construct()
    {
        $this->messageRepository        = new MessageRepository();
        $this->messageHistoryRepository = new MessageHistoryRepository();
    }

    /**
     * @return MessageModel[]
     */
    public function all(): array
    {
        $data   = $this->messageRepository->all();
        $result = [];

        if (!empty($data)) {
            foreach ($data as $item) {
                $model = new MessageModel();

                $model->setId($item['id']);
                $model->setMessage($item['message']);
                $model->setDateModified($item['date_modified']);
                $model->setDateCreated($item['date_created']);
                $model->setAuthor($item['author']);

                $result[] = $model;
            }
        }

        return $result;
    }

    public function post(string $author, string $message): bool
    {
        $insert = true;

        try {
            $this->messageRepository->transaction();
            $this->messageRepository->post($author, $message);
            $this->messageHistoryRepository->post($this->messageRepository->lastInsertId(), $message);
            $this->messageRepository->commit();
        } catch (PDOException $e) {
            $insert = false;
            $this->messageRepository->rollback();
        }

        return $insert;
    }

    public function delete(int $id): void
    {
        $this->messageRepository->deleteById($id);
    }

    public function edit(int $id, string $message): bool
    {
        $update = true;

        try {
            $this->messageRepository->transaction();
            $this->messageRepository->edit($id, $message);
            $this->messageHistoryRepository->post($id, $message);
            $this->messageRepository->commit();
        } catch (PDOException $e) {
            $update = false;
            $this->messageRepository->rollback();
        }

        return $update;
    }
}