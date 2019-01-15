<?php

namespace Src\Models;

class MessageModel implements ModelInterFace
{
    public function getTable()
    {
        // TODO: Implement getTable() method.
        return $this->table;
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
     * @var string
     */
    public $table = 'message';

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $message;

    /**
     * @var string
     */
    private $dateModified;

    /**
     * @var string
     */
    private $dateCreated;

    /**
     * @var string
     */
    private $author;

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

    /**
     * @return string
     */
    public function getDateCreated(): string
    {
        return $this->dateCreated;
    }

    /**
     * @param string $dateCreated
     */
    public function setDateCreated(string $dateCreated)
    {
        $this->dateCreated = $dateCreated;
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

}