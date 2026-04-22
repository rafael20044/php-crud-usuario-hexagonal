<?php

class Flash{

    public function __construct() {}

    public static function start(): void{
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set(string $key, mixed $value): void{
        self::start();
        $_SESSION['_flash'][$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed{
        self::start();
        
        if (!isset($_SESSION['_flash'][$key])) {
            return $default;
        }
        
        $value = $_SESSION['_flash'][$key];
        unset($_SESSION['_flash'][$key]);
        return $value;
    }

    /** @param array<string,string> $form */
    public static function setOld(array $form): void{
        self::set('old_form', $form);
    }

    /** @return array<string,string> */
    public static function getOld(): array{
        $data = self::get('old_form', []);
        return is_array($data) ? $data : [];
    }

    public static function setError(array $errors): void{
        self::set('errors', $errors);
    }

    /** @return array<string,string> */
    public static function getErrors(): array{
        $data = self::get('errors', []);
        return is_array($data) ? $data : [];
    }

    public static function setMessage(string $message): void{
        self::set('message', $message);
    }

    public static function getMessage(): string{
        $data = self::get('message', '');
        return is_string($data) ? $data : '';
    }

    public static function setSuccess(string $message): void{
        self::setMessage('success', $message);
    }

    public static function getSuccess(): string{
        $data = self::getMessage();
        return is_string($data) ? $data : '';
    }
}