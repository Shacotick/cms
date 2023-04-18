<?php

namespace Models;
use core\Core;

class User
{
    protected static $tableName = "user";
    public static function addUser($login, $password, $lastname, $firstname)
    {
        \core\Core::getInstance()->db->insert(
            self::$tableName, 
            [
                "login"         => $login,
                "password"      => $password,
                "lastname"      => $lastname,
                "firstname"     => $firstname
            ]
        );
    }

    public static function updateUser()
    {

    }

    public static function showUsers()
    {

    }

    public static function deleteUser()
    {
        
    }
}