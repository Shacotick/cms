<?php

namespace Models;
use core\Core;

/**
 * Клас таблиці БД user
 */
class User
{
    /**
     * Назва таблиці БД
     *
     * @var string
     */
    protected static $tableName = "user";

    /**
     * Метод добавляє нового користувача в БД
     *
     * @param mixed $login
     * @param mixed $password
     * @param mixed $lastname
     * @param mixed $firstname
     * 
     * @return [type]
     * 
     */
    public static function addUser($login, $password, $lastname, $firstname, $access_level = 1)
    {
        Core::getInstance()->db->insert(
            self::$tableName, 
            [
                "login"         => $login,
                "password"      => self::hashPassword($password),
                "lastname"      => $lastname,
                "firstname"     => $firstname,
                "access_level"  => $access_level
            ]
        );
    }

    public static function addProjectForJournalist($journalist_id, $project_id)
    {
        Core::getInstance()->db->insert(
            "projectsjournalists", 
            [
                "journalist_id" => $journalist_id,
                "project_id" => $project_id
            ]
        );
    }

    public static function updateUser($id, $updatesArray)
    {
        $updatesArray = \core\Utils::filterArray($updatesArray, [
            "lastname", "firstname"
        ]);

        Core::getInstance()->db->update(
            self::$tableName,
            $updatesArray,
            [
                "id" => $id
            ]
        );
    }

    public static function showUsers($whereParts = null)
    {
        if(!is_null($whereParts))
            return Core::getInstance()->db->select(self::$tableName, '*', $whereParts);
        return Core::getInstance()->db->select(self::$tableName);
    }

    public static function deleteUser($id)
    {
        Core::getInstance()->db->delete(
            self::$tableName,
            [
                "id" => $id 
            ]
        );
    }

    public static function getLastAddedValues()
    {
        $rows = Core::getInstance()->db->selectLastAddedItem(self::$tableName);
        return $rows;
    }
    
    public static function getUsersAndProjects()
    {
        $result = Core::getInstance()->db->select("projectsjournalists",
        [
            "user.id", "user.login", "user.lastname", "user.firstname",
            "user.access_level", "projectsjournalists.project_id",
            "projects.name" 
        ], null,
        [
            "user", "projects" 
        ],
        [
            "user.id = projectsjournalists.journalist_id", 
            "projectsjournalists.project_id = projects.id"
        ]);

        return $result;
    }

    public static function isEmailExists($login)
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*', [
            'login' => $login
        ]);
        return !empty($user);
    }

    public static function verifyUser($login, $password)
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*', [
            'login' => $login,
            'password' => $password
        ]);
        return !empty($user);
    }

    public static function getUserByLoginAndPassword($login, $password)
    {
        $user = Core::getInstance()->db->select(self::$tableName, '*', [
            'login' => $login,
            'password' => self::hashPassword($password)
        ]);

        if(!empty($user))
            return $user[0];
        return null;
    }

    public static function authenticateUser($user)
    {
        $_SESSION['user'] = $user;
    }
    
    public static function logoutUser()
    {
        unset($_SESSION['user']);
    }
    
    public static function isUserAunthenticated()
    {
        return isset($_SESSION['user']);
    }

    public static function getCurrentAunthenticatedUser()
    {
        return $_SESSION['user'];
    }

    public static function isAdmin()
    {
        $user = self::getCurrentAunthenticatedUser();
        return $user["access_level"] == 10;
    }

    public static function hashPassword($password)
    {
        return md5($password);
    }
}