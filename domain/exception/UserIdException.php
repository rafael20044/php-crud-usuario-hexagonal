<?php

require_once __DIR__ . '/DomainException.php';

final class UserIdException extends DomainException{

    private const MESSAGE_ID_IS_EMPTY = 'El id no puede estar vacio';

    public function __construct() {}

    public static function becauseIsEmpty(): self{
        return new self(self::MESSAGE_ID_IS_EMPTY);
    }
}