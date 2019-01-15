<?php

namespace Src\Models;

class MessageHistoryModel implements ModelInterFace
{
    public function getTable()
    {
        // TODO: Implement getTable() method.
        return 'message_history';
    }

    public function getPrimary()
    {
        // TODO: Implement getPrimary() method.
        return 'id';
    }

    public function getInstance()
    {
        // TODO: Implement getInstance() method.
        return self::class;
    }


    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $author;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $dateCreate;

    /**
     * @var string
     */
    private $dateModified;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author)
    {
        $this->author = $author;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage(string $message)
    {
        $this->message = $message;
    }

    /**
     * @return string
     */
    public function getDateCreate(): string
    {
        return $this->dateCreate;
    }

    /**
     * @param string $dateCreate
     */
    public function setDateCreate(string $dateCreate)
    {
        $this->dateCreate = $dateCreate;
    }

    /**
     * @return string
     */
    public function getDateModified(): string
    {
        return $this->dateModified;
    }

    /**
     * @param string $dateModified
     */
    public function setDateModified(string $dateModified)
    {
        $this->dateModified = $dateModified;
    }
}