<?php

require_once __DIR__ . '/../valueObject/UserId.php.php';
require_once __DIR__ . '/../valueObject/UserName.php.php';
require_once __DIR__ . '/../valueObject/UserEmail.php';
require_once __DIR__ . '/../valueObject/UserPassword.php';
require_once __DIR__ . '/../enums/UserRoleEnum.php';
require_once __DIR__ . '/../enums/UserStatusEnum.php';

final class UserModel{

    private UserId $id;
    private UserName $name;
    private UserEmail $email;
    private UserPassword $password;
    private string $role;
    private string $status;

    public function __construct(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password,
        string $role,
        string $status
    ) {

        UserRoleEnum::ensureIsValid($role);
        UserStatusEnum::ensureIsValid($status);

        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
    }

    public static function create(
        UserId $id,
        UserName $name,
        UserEmail $email,
        UserPassword $password
    ): self {
        return new self(
            $id,
            $name,
            $email,
            $password,
            UserRoleEnum::MEMBER,
            UserStatusEnum::PENDING
        );
    }

    public function active(): self {
        return new self(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            $this->role,
            UserStatusEnum::ACTIVE
        );
    }

    public function inactive(): self {
        return new self(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            $this->role,
            UserStatusEnum::INACTIVE
        );
    }

    public function block(): self {
        return new self(
            $this->id,
            $this->name,
            $this->email,
            $this->password,
            $this->role,
            UserStatusEnum::BLOCKED
        );
    }

    public function getUserId(): UserId {
        return $this->id;
    }

    public function getUserName(): UserName {
        return $this->name;
    }

    public function getUserEmail(): UserEmail {
        return $this->email;
    }

    public function getUserPassword(): UserPassword {
        return $this->password;
    }

    public function getUserIdValue(): string {
        return $this->getUserId()->getId();
    }

    public function getUserNameValue(): string {
        return $this->getUserName()->getName();
    }

    public function getUserEmailValue(): string {
        return $this->getUserEmail()->getEmail();
    }

    public function getUserPasswordValue(): string {
        return $this->getUserPassword()->getPassword();
    }

    public function getRole(): string {
        return $this->role;
    }

    public function getStatus(): string {
        return $this->status;
    }

} 