<?php

require_once __DIR__ . '/UserDomainException.php';

final class UserRoleException extends UserDomainException{

    private const MESSAGE_ROLE_IS_EMPTY = 'El rol no puede estar vacio';
    private const MESSAGE_ROLE_IS_INVALID = 'El rol es invalido';

    public function __construct() {}

    public static function becauseIsEmpty(): self{
        return new self(self::MESSAGE_ROLE_IS_EMPTY);
    }

    public static function becauseIsInvalid(): self{
        return new self(self::MESSAGE_ROLE_IS_INVALID);
    }
}