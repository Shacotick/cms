<?php

namespace core;

/**
 * Клас для виконання запитів до БД
 */
class DB
{
    /**
     * [Description for $pdo]
     *
     * @var [type]
     */
    protected $pdo;

    /**
     * [Description for __construct]
     *
     * @param mixed $hostname
     * @param mixed $login
     * @param mixed $password
     * @param mixed $database
     * 
     */
    public function __construct($hostname, $login, $password, $database)
    {
        $this->pdo = new \PDO("mysql: host={$hostname}; dbname={$database}", $login, $password);
    }


    /**
     * [Description for __construct]
     *
     * @param mixed $tableName
     * @param mixed $fieldsList
     * @param mixed $conditionArray
     * 
     */
    public function select($tableName, $fieldsList = "*", $conditionArray = null)
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
    }


    /**
     * [Description for update]
     *
     * @param mixed $tableName
     * @param mixed $newValuesArray
     * @param mixed $conditionArray
     * 
     * @return [type]
     * 
     */
    public function update($tableName, $newValuesArray, $conditionArray)
    {
        $paramsArray = [];

        $setParts = [];
        foreach ($newValuesArray as $key => $value)
        {
            $setParts[] = "{$key} = :set{$key}";
            $paramsArray["set" . $key] = $value;
        }
        $setPartString = implode(", ", $setParts);

        $whereParts = [];
        foreach ($conditionArray as $key => $value)
        {
            $whereParts[] = "{$key} = :{$key}";  
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE " . implode(" AND ", $whereParts);

        $res = $this->pdo->prepare("UPDATE {$tableName} SET {$setPartString} {$wherePartString}");
        $res->execute($paramsArray);
    }

    /**
     * [Description for insert]
     *
     * @param mixed $tableName
     * @param mixed $newRowArray
     * 
     * @return [type]
     * 
     */
    public function insert($tableName, $newRowArray)
    {
        $fieldsArray = array_keys($newRowArray);
        $fieldsListString = implode(", ", $fieldsArray);
        
        $paramsArray = [];
        foreach($newRowArray as $key => $value)
            $paramsArray[] = ":" . $key;
        
        $valuesListString = implode(", ", $paramsArray);
        $res = $this->pdo->prepare("INSERT INTO {$tableName} ($fieldsListString) VALUES ($valuesListString)");
        $res->execute($newRowArray);
    }

    /**
     * [Description for delete]
     *
     * @param mixed $tableName
     * @param mixed $conditionArray
     * 
     * @return [type]
     * 
     */
    public function delete($tableName, $conditionArray)
    {
        $whereParts = [];
        foreach ($conditionArray as $key => $value)
        {
            $whereParts[] = "{$key} = :{$key}";  
            $paramsArray[$key] = $value;
        }
        $wherePartString = "WHERE " . implode(" AND ", $whereParts);

        $res = $this->pdo->prepare("DELETE FROM {$tableName} {$wherePartString}");
        $res->execute($conditionArray);
    }
}
