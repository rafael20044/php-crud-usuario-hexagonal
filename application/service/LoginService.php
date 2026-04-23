<?php

require_once __DIR__ . '/../port/in/LoginUseCase.php';
require_once __DIR__ . '/dto/command/LoginCommand.php';
require_once __DIR__ . '/../../domain/valueObject/UserPassword.php';

class LoginService implements LoginUseCase{

    private GetUserByEmailPort $emailPort;

    public function __construct(GetUserByEmailPort $emailPort){
        $this->emailPort = $emailPort;
    }

    public function execute(LoginCommand $command): UserModel
    {
        $email = new UserEmail($command->getEmail());
        $user = $this->emailPort->getUserByEmail($email);

        if ($user === null) {
            throw UserNotFoundException::becauseEmailNotExists($email->getEmail());
        }

        $result = UserPassword::match($command->getPassword(), $user->getUserPassword());

        if ($result === false) {
            throw UserPasswordException::becauseNotMatch();
        }

        return $user;
    }
}