<?php

namespace core;

/**
 * Клас для виконання запитів до БД
 */
class DB
{
    /**
     * Об'єкт класу PDO, для роботи з БД
     *
     * @var [type]
     */
    protected $pdo;

    /**
     * Конструктор класу утворює з'єднання з БД
     *
     * @param mixed $hostname
     * @param mixed $login
     * @param mixed $password
     * @param mixed $database
     *
     */
    public function __construct($hostname, $login, $password, $database)
    {
        $this->pdo = new \PDO ("mysql: host={$hostname}; dbname={$database}", $login, $password);
    }

    /*public function select($tableName, $fieldsList = "*", $conditionArray = null)
    {
    if (is_array($fieldsList))
    $fieldsList = implode(", ", $fieldsList);

    $wherePart = "";
    if (is_array($conditionArray)) {
    $parts = [];
    foreach ($conditionArray as $key => $value) {
    $parts[] = "{$key} = :{$key}";
    }
    $wherePart = "WHERE " . implode(" AND ", $parts);
    }
    $res = $this->pdo->prepare("SELECT {$fieldsList} FROM {$tableName} {$wherePart}");
    $res->execute($conditionArray);

    return $res->fetchAll(\PDO::FETCH_ASSOC);
    }*/

    /**
     * Виконує вибірку рядків з вказаної таблиці
     *
     * @param string $tableName
     * @param string|array $fieldsList
     * @param array|null $conditionArray
     *
     */
    public function select($tableName, $fieldsList = "*", $conditionArray = null, $joinTables = null, $joinCondition = null)
    {
        if (is_array($fieldsList)) {
            $fieldsList = implode(", ", $fieldsList);
        }

        $joinPart = "";
        if (is_array($joinTables) && is_array($joinCondition)) {
            $joinParts = [];
            foreach ($joinTables as $key => $table) {
                $joinParts[] = "JOIN {$table} ON {$joinCondition[$key]}";
            }
            $joinPart = implode(" ", $joinParts);
        }

        $wherePart = "";
        if (is_array($conditionArray)) {
            $parts = [];
            foreach ($conditionArray as $key => $value) {
                $parts[] = "{$key} = :{$key}";
            }
            $wherePart = "WHERE " . implode(" AND ", $parts);
        }

        $query = "SELECT {$fieldsList} FROM {$tableName} {$joinPart} {$wherePart}";
        $res = $this->pdo->prepare($query);
        $res->execute($conditionArray);

        return $res->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Оновлює інформацію певного рядка в вказаній таблиці
     *
     * @param string $tableName
     * @param array $newValuesArray
     * @param array $conditionArray
     *
     * @return [type]
     *
     */
    public function update($tableName, $newValuesArray, $conditionArray)
    {
        $paramsArray = [];

        $setParts = [];
        foreach ($newValuesArray as $key => $value) {
            $setParts[] = "{$key} = :set{$key}";
            $paramsArray["set" . $key] = $value;
        }
        $setPartString = implode(", ", $setParts);

        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts[] = "{$key} = :{$key}";
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE " . implode(" AND ", $whereParts);

        $res = $this->pdo->prepare("UPDATE {$tableName} SET {$setPartString} {$wherePartString}");
        $success = $res->execute($paramsArray);

        return $success;
    }

    /**
     * Добавляє новий рядок у вказану таблицю
     *
     * @param string $tableName
     * @param array $newRowArray
     *
     * @return [type]
     *
     */
    public function insert($tableName, $newRowArray)
    {
        $fieldsArray = array_keys($newRowArray);
        $fieldsListString = implode(", ", $fieldsArray);

        $paramsArray = [];
        foreach ($newRowArray as $key => $value) {
            $paramsArray[] = ":" . $key;
        }

        $valuesListString = implode(", ", $paramsArray);
        $res = $this->pdo->prepare("INSERT INTO {$tableName} ($fieldsListString) VALUES ($valuesListString)");
        $success = $res->execute($newRowArray);

        return $success;
    }

    /**
     * Видаляє рядок з вказаної таблиці
     *
     * @param string $tableName
     * @param array $conditionArray
     *
     * @return [type]
     *
     */
    public function delete($tableName, $conditionArray)
    {
        $whereParts = [];
        foreach ($conditionArray as $key => $value) {
            $whereParts[] = "{$key} = :{$key}";
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE " . implode(" AND ", $whereParts);

        $res = $this->pdo->prepare("DELETE FROM {$tableName} {$wherePartString}");
        $success = $res->execute($conditionArray);

        return $success;
    }

    public function selectLastAddedItem($tableName)
    {
        $statement = $this->pdo->prepare(
            "SELECT * FROM $tableName ORDER BY id DESC LIMIT 1"
        );
        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC);
    }
}
