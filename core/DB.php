<?php

namespace core;

use PDO;

class DB
{
    protected $pdo;
    public function __construct($hostname, $login, $password, $database)
    {
        $this->pdo = new \PDO("mysql: host={$hostname}; dbname={$database}", $login, $password);
    }

    private $login = "cms";
    private $password = "cms";
    public function select($tableName, $fieldsList = "*", $conditionArray = null)
    {
        $res = $this->pdo->prepare("SELECT :fieldsList FROM :tableName WHERE login = :login AND password = :password");
        $res->execute([
            ":fieldsList"   =>      $fieldsList,
            ":tableName"    =>      $tableName,
            ":login"        =>      $this->login,
            ":password"     =>      $this->password
        ]);

        $row = $res->fetch(\PDO::FETCH_ASSOC); 
    }
}