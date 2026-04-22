<?php

require_once __DIR__ . '/../port/in/GetUserIdIUseCase.php';
require_once __DIR__ . '/../port/out/GetUserByIdPort.php';
require_once __DIR__ . '/mapper/UserMapperService.php';

final class GetUserByIdService implements GetUserIdIUseCase{

    private GetUserByIdPort $getUserByIdPort;
    public function __construct(GetUserByIdPort $getUserByIdPort){
        $this->getUserByIdPort = $getUserByIdPort;
    }

    public function execute(GetUserByIdQuery $query): UserModel
    {
        $userId = UserMapperService::fromGetByIdQueryToUserId($query);

        $user = $this->getUserByIdPort->getUserById($userId);

        if ($user === null){
            throw UserNotFoundException::becauseIdNotExists($userId->getId());
        }

        return $user;
    }
}