<?php

require_once __DIR__ . '/UserDomainException.php';

final class UserNameException extends UserDomainException{

    private const MESSAGE_NAME_IS_EMPTY = 'El nombre no puede estar vacio';

    public function __construct() {}

    public static function becauseIsEmpty(): self{
        return new self(self::MESSAGE_NAME_IS_EMPTY);
    }
}