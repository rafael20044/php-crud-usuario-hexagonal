<?php

require_once __DIR__ . '/../../../../../application/service/dto/command/CreateUserCommand.php';
require_once __DIR__ . '/../../../../../application/service/dto/command/UpdateUserCommand.php';
require_once __DIR__ . '/../../../../../application/service/dto/command/DeleteUserCommand.php';
require_once __DIR__ . '/../../../../../application/service/dto/query/GetUserByIdQuery.php';
require_once __DIR__ . '/../../../../../application/service/dto/query/GetAllUserQuery.php';

require_once __DIR__ . '/../../../../../domain/model/UserModel.php';

require_once __DIR__ . '/../dto/CreateUserRequest.php';
require_once __DIR__ . '/../dto/UpdateUserRequest.php';
require_once __DIR__ . '/../dto/UserResponse.php';

class UserWebMapper
{

    public function __construct() {}

    public function fromCreateRequestToCommand(CreateUserRequest $request): CreateUserCommand
    {
        return new CreateUserCommand(
            $request->getId(),
            $request->getName(),
            $request->getEmail(),
            $request->getPassword(),
            $request->getRole(),
            $request->getStatus()
        );
    }

    public function fromUpdateRequestToCommand(UpdateUserRequest $request): UpdateUserCommand
    {
        return new UpdateUserCommand(
            $request->getId(),
            $request->getName(),
            $request->getEmail(),
            $request->getPassword(),
            $request->getRole(),
            $request->getStatus()
        );
    }

    public function fromIdToGetByIdQuery(string $id): GetUserByIdQuery
    {
        return new GetUserByIdQuery($id);
    }

    public function fromIdToDeleteCommand(string $id): DeleteUserCommand
    {
        return new DeleteUserCommand($id);
    }

    public function fromModelToResponse(UserModel $model): UserResponse
    {
        return new UserResponse(
            $model->getUserIdValue(),
            $model->getUserNameValue(),
            $model->getUserEmailValue(),
            $model->getRole(),
            $model->getStatus()
        );
    }

    /**
     * @param UserModel[] $models
     * @return UserResponse[]
     */
    public function fromModelsToResponses(array $models): array
    {
        $responses = [];
        foreach ($models as $model) {
            $responses[] = $this->fromModelToResponse($model);
        }
        return $responses;
    }
}
