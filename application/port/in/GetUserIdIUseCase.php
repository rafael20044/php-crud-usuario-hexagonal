<?php

require_once __DIR__ . '/../../service/dto/query/GetUserByIdQuery.php';
require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface GetUserIdIUseCase{
    public function execute(GetUserByIdQuery $query): UserModel;
}