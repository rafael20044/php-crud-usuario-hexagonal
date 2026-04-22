<?php

require_once __DIR__ . '/../port/in/DeleteUserUseCase.php';
require_once __DIR__ . '/../port/out/DeleteUserPort.php';
require_once __DIR__ . '/../port/out/GetUserByIdPort.php';
require_once __DIR__ . '/dto/command/DeleteUserCommand.php';
require_once __DIR__ . '/mapper/UserMapperService.php';
require_once __DIR__ . '/../../domain/exception/UserNotFoundException.php';

final class DeleteUserService implements DeleteUserUseCase{

    private DeleteUserPort $deleteUserPort;
    private GetUserByIdPort $getUserByIdPort;

    public function __construct(DeleteUserPort $deleteUserPort, GetUserByIdPort $getUserByIdPort){
        $this->deleteUserPort = $deleteUserPort;
        $this->getUserByIdPort = $getUserByIdPort;
    }

    public function execute(DeleteUserCommand $command): void
    {
        $userId = UserMapperService::fromDeleteCommandToUserId($command);

        $user = $this->getUserByIdPort->getUserById($userId);

        if ($user === null){
            throw UserNotFoundException::becauseIdNotExists($userId->getId());
        }

        $this->deleteUserPort->delete($userId);
    }
}