<?php

require_once __DIR__ . '/../exception/UserPasswordException.php';

final class UserPassword{

    private const MIN_LENGTH = 6;
    private string $password;

    public function __construct(string $password) {
        $this->validatePassword($password);
        $this->password = $password;
    }

    public function getPassword(): string{
        return $this->password;
    }

    private function validatePassword(string $password): void{
        if (empty($password)) {
            throw UserPasswordException::becauseIsEmpty();
        }

        if (strlen($password) < self::MIN_LENGTH) {
            throw UserPasswordException::becauseIsTooShort();
        }
    }

}