<?php

require_once __DIR__ . '/../../service/dto/query/GetAllUserQuery.php';
require_once __DIR__ . '/../../../domain/model/UserModel.php';

interface GetAllUserUseCase{
    /** @return UserModel[] */
    public function execute(GetAllUserQuery $query): array;
}