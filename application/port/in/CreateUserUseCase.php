<?php

require_once __DIR__ . '/../../service/dto/command/CreateUserCommand.php';
require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface CreateUserUseCase{
    public function execute(CreateUserCommand $command): UserModel;
}