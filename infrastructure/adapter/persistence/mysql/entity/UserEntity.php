<?php

final class UserEntity{
    private string $id;
    private string $name;
    private string $email;
    private string $password;
    private string $role;
    private string $status;
    private ?string $createdAt;
    private ?string $updatedAt;

    public function __construct(
        string $id,
        string $name,
        string $email,
        string $password,
        string $role,
        string $status,
        ?string $createdAt,
        ?string $updatedAt
    ){
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->status = $status;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function getId(): string{
        return $this->id;
    }

    public function getName(): string{
        return $this->name;
    }

    public function getEmail(): string{
        return $this->email;
    }

    public function getPassword(): string{
        return $this->password;
    }

    public function getRole(): string{
        return $this->role;
    }

    public function getStatus(): string{
        return $this->status;
    }

    public function getCreatedAt(): ?string{
        return $this->createdAt;
    }

    public function getUpdatedAt(): ?string{
        return $this->updatedAt;
    }
}