<?php

require_once __DIR__ . '/../port/in/CreateUserUseCase.php';
require_once __DIR__ . '/../port/out/SaveUserPort.php';
require_once __DIR__ . '/../port/out/GetUserByEmailPort.php';
require_once __DIR__ . '/../service/dto/command/CreateUserCommand.php';
require_once __DIR__ . '/../../domain/model/UserModel.php';
require_once __DIR__ . '/../../domain/valueObject/UserEmail.php';
require_once __DIR__ . '/../../domain/exception/UserEmailException.php';
require_once __DIR__ . '/mapper/UserMapperService.php';

final class CreateUserService implements CreateUserUseCase{

    private SaveUserPort $port;
    private GetUserByEmailPort $emailPort;

    public function __construct(SaveUserPort $port, GetUserByEmailPort $emailPort){
        $this->port = $port;
        $this->emailPort = $emailPort;
    }

    public function execute(CreateUserCommand $command): UserModel{
        $email = $this->emailPort->getUserByEmail(new UserEmail($command->getEmail()));
        if($email){
            throw UserEmailException::becauseAlreadyExists();
        }
        $model = UserMapperService::fromCreateCommandToModel($command);
        return $this->port->save($model);
    }

}