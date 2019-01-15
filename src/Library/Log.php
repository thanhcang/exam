<?php

namespace Src\Library;

class Log
{
    private $handle;

    public function __construct()
    {
        $this->handle = fopen(__DIR__ . '/../../storage/system.log', 'a');
    }

    public function write($message)
    {
        fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
    }


    public function __destruct()
    {
        fclose($this->handle);
    }
}