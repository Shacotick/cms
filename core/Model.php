<?php

namespace core;

class Model
{
    public static function getAllFromTable($tableName)
    {
        $rows = Core::getInstance()->db->select($tableName);
        return $rows;
    }

    public static function addToTable($tableName, $fields)
    {
        Core::getInstance()->db->insert(
            $tableName, $fields
        );
    }

    public static function editInTable($tableName, $fields, $value)
    {
        Core::getInstance()->db->update(
            $tableName, $fields, $value
        );
    }

    public static function deleteFromTable($tableName, $id)
    {
        Core::getInstance()->db->delete(
            $tableName,
            [
                "id" => $id
            ]
        );
    }

    public static function getByIdFromTable($tableName, $id)
    {
        $rows = Core::getInstance()->db->select(
            $tableName,
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

    public static function getByValueFromTable($tableName, $value)
    {
        $rows = Core::getInstance()->db->select($tableName, "*", $value);
        return $rows;
    }
}