<?php

namespace Models;

use core\Core;

/**
 * Клас таблиці БД user
 */
class Pages
{
    protected static $tableName = "pages";

    public static function add($title, $project_id)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                "title" => $title,
                "project_id" => $project_id
            ]
        );
    }

    public static function delete($id)
    {
        Core::getInstance()->db->delete(
            self::$tableName,
            [
                "id" => $id
            ]
        );
    }

    public static function edit($id, $name)
    {
        Core::getInstance()->db->update(
            self::$tableName,
            [
                "name" => $name
            ],
            [
                "id" => $id
            ]
        );
    }

    public static function getById($id)
    {
        $rows = Core::getInstance()->db->select(
            self::$tableName,
            "*",
            [
                "id" => $id
            ]
        );
        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getAll()
    {
        $rows = Core::getInstance()->db->select(self::$tableName);
        return $rows;
    }

    public static function getMainPageByProjectId($project_id)
    {
        $rows = Core::getInstance()->db->select(
            self::$tableName,
            "*",
            [
                "project_id" => $project_id,
                "isMain" => 1
            ]
        );
        if (!empty($rows))
            return $rows[0];
        else
            return null;
    }

    public static function getPagesByProjectId($project_id)
    {
        $rows = Core::getInstance()->db->select(
            self::$tableName,
            "*",
            [
                "project_id" => $project_id
            ]
        );
        return $rows;
    }
}