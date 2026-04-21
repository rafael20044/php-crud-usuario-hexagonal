<?php

require_once __DIR__ . '/../../../domain/valueObject/UserEmail.php';
require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface GetUserByEmailPort{
    public function getUserByEmail(UserEmail $email): UserModel;
}