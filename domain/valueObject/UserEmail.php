<?php

require_once __DIR__ . '/../exception/UserEmailException.php';

final class UserEmail{

    private string $email;

    public function __construct(string $email) {
        $this->validateEmail($email);
        $this->email = $email;
    }

    public function getEmail(): string{
        return $this->email;
    }

    private function validateEmail(string $email): void{
        if (empty($email)) {
            throw UserEmailException::becauseIsEmpty();
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw UserEmailException::becauseInvalidFormat();
        }
    }

}