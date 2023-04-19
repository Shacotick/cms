<?php

namespace Models;
use core\Core;

/**
 * [Description User]
 */
class User
{
    /**
     * [Description for $tableName]
     *
     * @var string
     */
    protected static $tableName = "user";

    /**
     * [Description for addUser]
     *
     * @param mixed $login
     * @param mixed $password
     * @param mixed $lastname
     * @param mixed $firstname
     * 
     * @return [type]
     * 
     */
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