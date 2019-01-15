<?php

namespace Src\Library;

use Src\Exception\SessionException;

class Session
{
    public static function start(): void
    {
        session_start();
    }

    public static function get(string $key)
    {
        if (!self::has($key)) {
            throw  new SessionException("key {$key} is not exists");
        }

        return $_SESSION[$key];
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function set(string $key, $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function remove(string $key): void
    {
        unset($_SESSION[$key]);
    }

    public static function destroy(): void
    {
        session_destroy();
    }
}