<?php

require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface UpdateUserPort{
    public function update(UserModel $user): UserModel;
}