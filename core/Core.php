<?php

namespace core;

use controllers\MainController;

/**
 * Ядро системи
 */
class Core
{
    /**
     * Змінна, яка містить саме ядро системи
     *
     * @var null
     */
    private static $instance = null;

    /**
     * Асоціативний масив для збереження основних данних ядра системи
     *
     * @var [type]
     */
    public $app;

    /**
     * Об'єкт класу бази данних
     *
     * @var [type]
     */
    public DB $db;

    /**
     * Конструктор класу, який ініціалізує масив app[]
     *
     */
    private function __construct()
    {
        $this->app = [];
    }

    /**
     * Метод, що повертає ядро системи. Всі операції з ядром системи проводяться через цей метод
     *
     * @return [type]
     * 
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Метод для ініціалізації бази даних
     *
     * @return [type]
     * 
     */
    public function Initialize()
    {
        $this->db = new DB(
            DATABASE_HOST,
            DATABASE_LOGIN,
            DATABASE_PASSWORD,
            DATABASE_BASENAME
        );
    }

    /**
     * Запуск системи. Формується адресна строка та перевіряється чи існує певний клас і метод в системі, 
     * що був введений в адресну строку
     * 
     * @return [type]
     * 
     */
    public function Run()
    {
        $route = $_GET['route'];
        $routeParts = explode('/', $route);

        $moduleName = strtolower(array_shift($routeParts));
        $actionName = strtolower(array_shift($routeParts));
        if (empty($moduleName))
            $moduleName = "main";
        if (empty($actionName))
            $actionName = "index";

        $this->app["moduleName"] = $moduleName;
        $this->app["actionName"] = $actionName;

        $contollerName = '\\controllers\\' . ucfirst($moduleName) . 'Controller';
        $contollerActionName = $actionName . 'Action';

        $statusCode = 200;
        if (class_exists($contollerName)) {
            $controller = new $contollerName();
            if (method_exists($controller, $contollerActionName))
                $this->app["actionResult"] = $controller->$contollerActionName();
            else {
                $statusCode = 404;
            }
        } else {
            $statusCode = 404;
        }

        $statusCodeType = intval($statusCode / 100);
        if ($statusCodeType == 4 || $statusCodeType == 5) {
            $mainController = new MainController();
            $mainController->errorAction($statusCode);
        }
    }

    /**
     * 
     *
     * @return [type]
     * 
     */
    public function Done()
    {
        $pathToLayout = "themes/light/layout.php";
        $tpl = new Template($pathToLayout);
        $tpl->setParam("content", $this->app["actionResult"]);
        $html = $tpl->getHTML();
        echo $html;
    }
}
