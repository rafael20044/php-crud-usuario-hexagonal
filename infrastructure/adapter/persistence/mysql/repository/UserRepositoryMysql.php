<?php

require_once __DIR__ . '/../../../../../application/port/out/DeleteUserPort.php';
require_once __DIR__ . '/../../../../../application/port/out/GetAllUserPort.php';
require_once __DIR__ . '/../../../../../application/port/out/GetUserByEmailPort.php';
require_once __DIR__ . '/../../../../../application/port/out/GetUserByIdPort.php';
require_once __DIR__ . '/../../../../../application/port/out/SaveUserPort.php';
require_once __DIR__ . '/../../../../../application/port/out/UpdateUserPort.php';
require_once __DIR__ . '/../../../../../common/Uuid.php';

final class UserRepositoryMysql implements
    SaveUserPort,
    UpdateUserPort,
    GetUserByIdPort,
    GetUserByEmailPort,
    GetAllUserPort,
    DeleteUserPort
{

    private PDO $pdo;
    private UserPersistenceMapper $mapper;

    public function __construct(
        PDO $pdo,
        UserPersistenceMapper $mapper
    ) {
        $this->pdo = $pdo;
        $this->mapper = $mapper;
    }

    public function save(UserModel $user): UserModel
    {
        $dto = $this->mapper->fromModelToDto($user);
        $uuid = Uuid::generateV4();

        $sql = '
            INSERT INTO users (
                id,
                name,
                email,
                password,
                role,
                status,
                created_at,
                updated_at
            ) VALUES (
                :id,
                :name,
                :email,
                :password,
                :role,
                :status,
                NOW(),
                NOW()
            )
        ';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $uuid,
            ':name' => $dto->getName(),
            ':email' => $dto->getEmail(),
            ':password' => $dto->getPassword(),
            ':role' => $dto->getRole(),
            ':status' => $dto->getStatus(),
        ]);

        $savedUser = $this->getUserById(new UserId($uuid));

        if ($savedUser === null) {
            throw new RuntimeException('User not found after save');
        }

        return $savedUser;
    }

    public function update(UserModel $user): UserModel
    {
        $dto = $this->mapper->fromModelToDto($user);
        $sql = '
            UPDATE users
            SET name = :name,
                email = :email,
                password = :password,
                role = :role,
                status = :status,
                updated_at = NOW()
            WHERE id = :id
        ';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $dto->getId(),
            ':name' => $dto->getName(),
            ':email' => $dto->getEmail(),
            ':password' => $dto->getPassword(),
            ':role' => $dto->getRole(),
            ':status' => $dto->getStatus(),
        ]);

        $updatedUser = $this->getUserById(new UserId($dto->getId()));

        if ($updatedUser === null) {
            throw new RuntimeException('The user could not be recovered after update.');
        }

        return $updatedUser;
    }

    public function getUserByEmail(UserEmail $email): ?UserModel
    {
        $sql = '
            SELECT
                id,
                name,
                email,
                password,
                role,
                status,
                created_at,
                updated_at
            FROM users
            WHERE email = :email
            LIMIT 1
        ';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':email' => $email->getEmail(),
        ]);

        $row = $statement->fetch();

        if ($row === false) {
            return null;
        }

        return $this->mapper->fromRowToModel($row);
    }

    public function getUserById(UserId $id): ?UserModel
    {
        $sql = '
            SELECT
                id,
                name,
                email,
                password,
                role,
                status,
                created_at,
                updated_at
            FROM users
            WHERE id = :id
            LIMIT 1
        ';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $id->getId(),
        ]);
        $row = $statement->fetch();
        if ($row === false) {
            return null;
        }
        return $this->mapper->fromRowToModel($row);
    }

    public function delete(UserId $id): void
    {
        $sql = 'DELETE FROM users WHERE id = :id';
        $statement = $this->pdo->prepare($sql);
        $statement->execute([
            ':id' => $id->getId(),
        ]);
    }

    public function getAllUser(): array
    {
        $sql = '
            SELECT
                id,
                name,
                email,
                password,
                role,
                status,
                created_at,
                updated_at
            FROM users
            ORDER BY name ASC
        ';
        $statement = $this->pdo->query($sql);
        $rows = $statement->fetchAll();
        return $this->mapper->fromRowsToModels($rows);
    }
}
