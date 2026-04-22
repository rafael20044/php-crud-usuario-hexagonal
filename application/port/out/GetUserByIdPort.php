<?php

require_once __DIR__ . '/../../../domain/model/UserModel.php';
require_once __DIR__ . '/../../../domain/valueObject/UserId.php';

interface GetUserByIdPort{
    public function getUserById(UserId $id): ?UserModel;
}