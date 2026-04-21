<?php

require_once __DIR__ . '/../../../domain/valueObject/UserId.php';

interface DeleteUserPort{
    public function delete(UserId $id): void;
}