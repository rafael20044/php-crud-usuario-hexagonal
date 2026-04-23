<?php

require_once __DIR__ .'/UserDomainException.php';

final class UserPasswordException extends UserDomainException{

    private const MESSAGE_PASSWORD_IS_EMPTY = 'La contraseña no puede estar vacia';
    private const MESSAGE_PASSWORD_IS_TOO_SHORT = 'La contraseña es muy corta';
    private const MESSAGE_PASSWORD_IS_NOT_MATCH = 'La contraseña no coincide';

    public function __construct() {}

    public static function becauseIsEmpty(): self{
        return new self(self::MESSAGE_PASSWORD_IS_EMPTY);
    }

    public static function becauseIsTooShort(): self{
        return new self(self::MESSAGE_PASSWORD_IS_TOO_SHORT);
    }

    public static function becauseNotMatch(): self{
        return new self(self::MESSAGE_PASSWORD_IS_NOT_MATCH);
    }
}