<?php

require_once __DIR__ . '/../exception/UserIdException.php';

final class UserId{

    private string $id;

    public function __construct(string $id) {
        $this->validateId($id);
        $this->id = $id;
    }

    public function getId(): string{
        return $this->id;
    }

    private function validateId(string $id): void{
        if (empty($id)) {
            throw UserIdException::becauseIsEmpty();
        }
    }

}