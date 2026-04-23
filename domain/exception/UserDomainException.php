<?php


class UserDomainException extends InvalidArgumentException{

    public function __construct(string $message) {
        parent::__construct($message);
    }

}