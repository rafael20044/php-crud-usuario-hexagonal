<?php

require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface SaveUserPort{
    public function save(UserModel $user): UserModel;
}