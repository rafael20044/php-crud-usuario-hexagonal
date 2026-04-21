<?php

require_once __DIR__ . '/../../service/dto/command/CreateUserCommand.php';
require_once __DIR__ . '/../../service/dto/command/UpdateUserCommand.php';
require_once __DIR__ . '/../../service/dto/command/DeleteUserCommand.php';
require_once __DIR__ . '/../../service/dto/query/GetUserByIdQuery.php';
require_once __DIR__ . '/../../../domain/model/UserModel.php';

require_once __DIR__ . '/../../../domain/valueObject/UserId.php';
require_once __DIR__ . '/../../../domain/valueObject/UserName.php';
require_once __DIR__ . '/../../../domain/valueObject/UserEmail.php';
require_once __DIR__ . '/../../../domain/valueObject/UserPassword.php';

final class UserMapperService{

    public function __construct(){}

    public static function fromCreateCommandToModel(CreateUserCommand $command): UserModel{
        $id = new UserId($command->getId());
        $name = new UserName($command->getName());
        $email = new UserEmail($command->getEmail());
        $password = UserPassword::fromTextPlain($command->getPassword());

        return UserModel::create($id, $name, $email, $password, $command->getRole());
    }

    public static function fromUpdateCommandToModel(UpdateUserCommand $command): UserModel{
        $id = new UserId($command->getId());
        $name = new UserName($command->getName());
        $email = new UserEmail($command->getEmail());
        $password = UserPassword::fromTextPlain($command->getPassword());

        return new UserModel($id, $name, $email, $password, $command->getRole(), $command->getStatus());
    }

    public static function fromDeleteCommandToUserId(DeleteUserCommand $command): UserId{
        return new UserId($command->getId());
    }

    public static function fromGetByIdQueryToUserId(GetUserByIdQuery $query): UserId{
        return new UserId($query->getId());
    }

    /** @return array<string, string> */
    public static function fromModelToArray(UserModel $model): array{
        return [
            'id' => $model->getUserIdValue(),
            'name' => $model->getUserNameValue(),
            'email' => $model->getUserEmailValue(),
            'password' => $model->getUserPasswordValue(),
            'role' => $model->getRole(),
            'status' => $model->getStatus()
        ];
    }

    /** 
     * @param UserModel[] $models 
     * @return array<int, array<string, string>>
     */
    public static function fromModelsToArray(array $models): array{
        $result = array();

        foreach($models as $model){
            $result[] = self::fromModelToArray($model);
        }

        return $result;
    }
}