<?php

require_once __DIR__ . '/DomainException.php';

final class UserEmailException extends DomainException{

    private const MESSAGE_EMAIL_IS_EMPTY = 'El correo electronico no puede estar vacio';
    private const MESSAGE_EMAIL_INVALID_FORMAT = 'El formato del correo electronico es invalido';
    private const MESSAGE_EMAIL_ALREADY_EXISTS = 'El correo electronico ya existe';

    public function __construct() {}

    public static function becauseIsEmpty(): self{
        return new self(self::MESSAGE_EMAIL_IS_EMPTY);
    }

    public static function becauseInvalidFormat(): self{
        return new self(self::MESSAGE_EMAIL_INVALID_FORMAT);
    }

    public static function becauseAlreadyExists(): self{
        return new self(self::MESSAGE_EMAIL_ALREADY_EXISTS);
    }
}