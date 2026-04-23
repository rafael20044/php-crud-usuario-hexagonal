<?php

require_once __DIR__ . '/UserDomainException.php';

final class UserNotFoundException extends UserDomainException{

    private const MESSAGE_ID = "El usuario con el id %s no existe";
    private const MESSAGE_EMAIL = "El usuario con el email %s no existe";

    private function __construct(){}

    public static function becauseIdNotExists(string $id): self{
        return new self(sprintf(self::MESSAGE_ID, $id));
    }

    public static function becauseEmailNotExists(string $email): self{
        return new self(sprintf(self::MESSAGE_EMAIL, $email));
    }
}