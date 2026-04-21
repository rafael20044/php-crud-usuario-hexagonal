<?php

require_once __DIR__ . '/../exception/UserRoleException.php';

final class UserRoleEnum{

    private const ADMIN = 'admin';
    private const MEMBER = 'member';
    private const REVIEWER = 'reviewer';

    public function __construct(){}

    public static function values(): array{
        return [
            self::ADMIN,
            self::MEMBER,
            self::REVIEWER
        ];
    }

    public static function isValid(string $role): bool{
        return in_array($role, self::values());
    }

    public static function ensureIsValid(string $role): void{
        if(!self::isValid($role)){
            throw UserRoleException::becauseIsInvalid();
        }
    }
}