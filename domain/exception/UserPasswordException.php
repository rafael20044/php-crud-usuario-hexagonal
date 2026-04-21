<?php

require_once __DIR__ .'/DomainException.php';

final class UserPasswordException extends DomainException{

    private const MESSAGE_PASSWORD_IS_EMPTY = 'La contraseña no puede estar vacia';
    private const MESSAGE_PASSWORD_IS_TOO_SHORT = 'La contraseña es muy corta';

    public function __construct() {}

    public static function becauseIsEmpty(): self{
        return new self(self::MESSAGE_PASSWORD_IS_EMPTY);
    }

    public static function becauseIsTooShort(): self{
        return new self(self::MESSAGE_PASSWORD_IS_TOO_SHORT);
    }
}