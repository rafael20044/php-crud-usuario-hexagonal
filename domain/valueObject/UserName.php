<?php

require_once __DIR__ . '/../exception/UserNameException.php';

final class UserName{

    private string $name;

    public function __construct(string $name) {
        $this->validateName($name);
        $this->name = $name;
    }

    public function getName(): string{
        return $this->name;
    }

    private function validateName(string $name): void{
        if (empty($name)) {
            throw UserNameException::becauseIsEmpty();
        }
    }

}