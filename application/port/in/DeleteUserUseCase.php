<?php

require_once __DIR__ . '/../../service/dto/command/DeleteUserCommand.php';

interface DeleteUserUseCase{
    public function execute(DeleteUserCommand $command): void;
}
