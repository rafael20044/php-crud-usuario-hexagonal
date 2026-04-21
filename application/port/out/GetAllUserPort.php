<?php

require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface GetAllUserPort{
    /** @return UserModel[] */
    public function getAllUser(): array;
}