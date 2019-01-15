<?php

namespace Src\Http\Validation;

abstract class BaseValidation
{

    /**
     * @var array
     */
    protected $errors = [];


    abstract protected function forms(): bool;

    abstract protected function db(): bool;

    protected function pushError(string $error)
    {
        $this->errors[] = $error;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public function check(): bool
    {
        if (!$this->forms()) {
            return false;
        }

        if (!$this->db()) {
            return false;
        }

        return true;
    }
}