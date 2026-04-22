<?php

final class Connection{

    private string $host;
    private string $port;
    private string $database;
    private string $username;
    private string $password;

    public function __construct(
        string $host,
        string $port,
        string $database,
        string $username,
        string $password
    ){
        $this->host = $host;
        $this->port = $port;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    public function createPdo(): PDO{
        $dns = sprintf(
            "mysql:host=%s;port=%s;dbname=%s", 
            $this->host, 
            $this->port, 
            $this->database
        );
        try{
            return new PDO(
                $dns, 
                $this->username, 
                $this->password, 
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
        }catch(PDOException $e){
            throw new Exception($e->getMessage());
        }
    }

}