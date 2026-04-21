<?php

require_once __DIR__ . '/../../service/dto/command/UpdateUserCommand.php';
require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface UpdateUserUseCase{
    public function execute(UpdateUserCommand $command): UserModel;
}