<?php

require_once __DIR__ . '/DomainException.php';

final class UserStatusException extends DomainException{

    private const MESSAGE_STATUS_IS_EMPTY = 'El estado no puede estar vacio';
    private const MESSAGE_STATUS_IS_INVALID = 'El estado es invalido';

    public function __construct() {}

    public static function becauseIsEmpty(): self{
        return new self(self::MESSAGE_STATUS_IS_EMPTY);
    }

    public static function becauseIsInvalid(): self{
        return new self(self::MESSAGE_STATUS_IS_INVALID);
    }
}