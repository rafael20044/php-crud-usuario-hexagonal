<?php

require_once __DIR__ . '/../exception/UserStatusException.php';

final class UserStatusEnum{

    private const ACTIVE = 'active';
    private const INACTIVE = 'inactive';
    private const PENDING = 'pending';
    private const BLOCKED = 'blocked';

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