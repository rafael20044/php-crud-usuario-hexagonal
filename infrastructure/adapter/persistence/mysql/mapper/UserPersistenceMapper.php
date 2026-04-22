<?php

require_once __DIR__ . '/../../../../../domain/model/UserModel.php';
require_once __DIR__ . '/../dto/UserPersistenceDto.php';
require_once __DIR__ . '/../entity/UserEntity.php';

final class UserPersistenceMapper
{

    public function __construct() {}

    public function fromModelToDto(UserModel $model): UserPersistenceDto
    {
        return new UserPersistenceDto(
            $model->getUserIdValue(),
            $model->getUserNameValue(),
            $model->getUserEmailValue(),
            $model->getUserPasswordValue(),
            $model->getRole(),
            $model->getStatus()
        );
    }

    public function fromDtoToEntity(UserPersistenceDto $dto): UserEntity
    {
        return new UserEntity(
            $dto->getId(),
            $dto->getName(),
            $dto->getEmail(),
            $dto->getPassword(),
            $dto->getRole(),
            $dto->getStatus(),
            null,
            null
        );
    }

    public function fromRowToEntity(array $row): UserEntity
    {
        return new UserEntity(
            (string) $row['id'],
            (string) $row['name'],
            (string) $row['email'],
            (string) $row['password'],
            (string) $row['role'],
            (string) $row['status'],
            isset($row['created_at']) ? (string) $row['created_at'] : null,
            isset($row['updated_at']) ? (string) $row['updated_at'] : null
        );
    }

    public function fromEntityToModel(UserEntity $entity): UserModel
    {
        return new UserModel(
            new UserId($entity->getId()),
            new UserName($entity->getName()),
            new UserEmail($entity->getEmail()),
            UserPassword::fromTextPlain($entity->getPassword()),
            $entity->getRole(),
            $entity->getStatus()
        );
    }

    public function fromRowToModel(array $row): UserModel
    {
        return $this->fromEntityToModel(
            $this->fromRowToEntity($row)
        );
    }

    /**
     * @param array<int, array<string, mixed>> $rows
     * @return UserModel[]
     */
    public function fromRowsToModels(array $rows): array
    {
        $models = array();
        foreach ($rows as $row) {
            $models[] = $this->fromRowToModel($row);
        }
        return $models;
    }
}
