<?php

namespace Models;

use core\Model;

class News extends Model
{
    protected static $tableName = "news";

    public static function getAll()
    {
        return parent::getAllFromTable(self::$tableName);
    }

    public static function add($fields)
    {
        parent::addToTable(self::$tableName, $fields);
    }

    public static function edit($fields, $value)
    {
        parent::editInTable(self::$tableName, $fields, $value);
    }

    public static function delete($id)
    {
        parent::deleteFromTable(self::$tableName, $id);
    }

    public static function getById($id)
    {
        return parent::getByIdFromTable(self::$tableName, $id);
    }

    public static function getByProjectId($projectId)
    {
        return parent::getByValueFromTable(self::$tableName, [
            "project_id" => $projectId,
        ]);
    }

    public static function getByProjectIdAndAuthor($projectId, $author)
    {
        return parent::getByValueFromTable(self::$tableName, [
            "project_id" => $projectId,
            "author" => $author
        ]);
    }

}
