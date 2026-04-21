<?php

require_once __DIR__ . '/../port/in/UpdateUserUseCase.php';
require_once __DIR__ . '/../port/out/UpdateUserPort.php';
require_once __DIR__ . '/../port/out/GetUserByIdPort.php';
require_once __DIR__ . '/../port/out/GetUserByEmailPort.php';
require_once __DIR__ . '/../service/dto/command/UpdateUserCommand.php';
require_once __DIR__ . '/../../domain/model/UserModel.php';
require_once __DIR__ . '/../../domain/valueObject/UserId.php';
require_once __DIR__ . '/../../domain/valueObject/UserEmail.php';
require_once __DIR__ . '/../../domain/valueObject/UserPassword.php';
require_once __DIR__ . '/../../domain/valueObject/UserName.php';
require_once __DIR__ . '/../../domain/exception/UserEmailException.php';
require_once __DIR__ . '/../../domain/exception/UserNotFoundException.php';
require_once __DIR__ . '/mapper/UserMapperService.php';

final class UpdateUserService implements UpdateUserUseCase{

    private UpdateUserPort $updatePort;
    private GetUserByIdPort $getUserByIdPort;
    private GetUserByEmailPort $getUserByEmailPort;

    public function __construct(UpdateUserPort $updatePort, GetUserByIdPort $getUserByIdPort, GetUserByEmailPort $getUserByEmailPort){
        $this->updatePort = $updatePort;
        $this->getUserByIdPort = $getUserByIdPort;
        $this->getUserByEmailPort = $getUserByEmailPort;
    }

    public function execute(UpdateUserCommand $command): UserModel{
        $id = new UserId($command->getId());
        $currentUser = $this->getUserByIdPort->getUserById($id);

        if($currentUser === null){
            throw UserNotFoundException::becauseIdNotExists($id->getId());
        }

        $newEmail = new UserEmail($command->getEmail());
        $userWithSameEmail = $this->getUserByEmailPort->getUserByEmail($newEmail);
        
        if ($userWithSameEmail !== null && !$userWithSameEmail->getUserId()->equals($id)) {
            throw UserEmailException::becauseAlreadyExists();
        }

        $password = ($command->getPassword() == '') 
            ? $currentUser->getUserPassword() 
            : UserPassword::fromTextPlain($command->getPassword());

        $userUpdate = new UserModel(
            $id,
            new UserName($command->getName()),
            new UserEmail($command->getEmail()),
            $password,
            $command->getRole(),
            $command->getStatus()
        );

        return $this->updatePort->update($userUpdate);
    }
}