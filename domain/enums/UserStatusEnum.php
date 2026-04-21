<?php

require_once __DIR__ . '/../exception/UserStatusException.php';

final class UserStatusEnum{

    public const ACTIVE = 'active';
    public const INACTIVE = 'inactive';
    public const PENDING = 'pending';
    public const BLOCKED = 'blocked';

    public function __construct(){}

    public static function values(): array{
        return [
            self::ACTIVE,
            self::INACTIVE,
            self::PENDING,
            self::BLOCKED
        ];
    }

    public static function isValid(string $status): bool{
        return in_array($status, self::values());
    }

    public static function ensureIsValid(string $status): void{
        if(!self::isValid($status)){
            throw UserStatusException::becauseIsInvalid();
        }
    }
}