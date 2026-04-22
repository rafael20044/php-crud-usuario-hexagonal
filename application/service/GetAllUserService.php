<?php

require_once __DIR__ . '/../port/in/GetAllUserUseCase.php';
require_once __DIR__ . '/../port/out/GetAllUserPort.php';

final class GetAllUserService implements GetAllUserUseCase{

    private GetAllUserPort $getAllUserPort;
    public function __construct(GetAllUserPort $getAllUserPort){
        $this->getAllUserPort = $getAllUserPort;
    }

    public function execute(GetAllUserQuery $query): array
    {
        return $this->getAllUserPort->getAllUser();
    }
}