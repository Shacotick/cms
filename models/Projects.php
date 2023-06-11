<?php

namespace Models;

use core\Core;

/**
 * Клас таблиці БД user
 */
class Projects
{
    protected static $tableName = "projects";

    public static function add($name)
    {
        Core::getInstance()->db->insert(
            self::$tableName,
            [
                "name" => $name
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

    public static function getByUserId($id)
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

    /**
     * Дістати останнє додане значення з таблиці
     *
     * @return [type]
     * 
     */
    public static function getLastAddedValues()
    {
        $rows = Core::getInstance()->db->selectLastAddedItem(self::$tableName);
        return $rows;
    }

    // Копіювання всіх файлів та папок з однієї папки в іншу
    public static function copyFolder($source, $destination) 
    {
        // Перевірка, чи існує вихідна папка
        if (!is_dir($source)) {
            return false;
        }

        // Перевірка, чи існує цільова папка, якщо ні - створюємо її
        if (!is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        // Отримання списку файлів та папок у вихідній папці
        $files = scandir($source);

        // Копіювання кожного файлу або папки
        foreach ($files as $file) {
            if ($file != "." && $file != "..") {
                $src = $source . '/' . $file;
                $dst = $destination . '/' . $file;

                // Копіювання файлу або папки
                if (is_dir($src)) {
                    self::copyFolder($src, $dst);
                } else {
                    copy($src, $dst);
                }
            }
        }

        return true;
    }

    public static function deleteDirectory($directory) {
        if (!file_exists($directory)) {
            return;
        }
        $files = array_diff(scandir($directory), array('.', '..'));
        foreach ($files as $file) {
            $path = $directory . '/' . $file;
    
            if (is_dir($path)) {
                self::deleteDirectory($path);
            } else {
                unlink($path);
            }
        }
    
        rmdir($directory);
    }
}