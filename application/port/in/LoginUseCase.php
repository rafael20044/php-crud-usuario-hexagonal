<?php

require_once __DIR__ . '/../../service/dto/command/LoginCommand.php';
require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface LoginUseCase
{
    public function execute(LoginCommand $command): UserModel;
}