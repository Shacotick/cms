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
     * Параметри кожної сторінки
     *
     * @var [type]
     */
    public $pageParams;

    /**
     * Об'єкт класу бази данних
     *
     * @var [type]
     */
    public $db;

    /**
     * [requestMethod від супермасиву REQUEST]
     *
     * @var [type]
     */
    public $requestMethod;

    /**
     * Конструктор класу, який ініціалізує масив app[]
     *
     */
    private function __construct()
    {
        global $pageParams;
        $this->app = [];
        $this->pageParams = $pageParams;
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
     * Метод для ініціалізації даних
     *
     * @return [type]
     * 
     */
    public function Initialize()
    {
        session_start();
        $this->db = new DB(
            DATABASE_HOST,
            DATABASE_LOGIN,
            DATABASE_PASSWORD,
            DATABASE_BASENAME
        );

        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
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
        $this->app["routeParts"] = $routeParts;

        $contollerName = '\\controllers\\' . ucfirst($moduleName) . 'Controller';
        $contollerActionName = $actionName . 'Action';

        $statusCode = 200;
        if (class_exists($contollerName)) {
            $controller = new $contollerName();
            if (method_exists($controller, $contollerActionName))
            {
                $actionResult = $controller->$contollerActionName($routeParts);
                if($actionResult instanceof Error)
                    $statusCode = $actionResult->code;   
                $this->pageParams['content'] = $actionResult;
                
                if($this->app['moduleName'] === "projects" && $this->app['actionName'] === "view")
                    $this->pageParams['isConstructor'] = true;
                else
                    $this->pageParams['isConstructor'] = false;
            }
            else {
                $statusCode = 404;
            }
        } else {
            $statusCode = 404;
        }

        $statusCodeType = intval($statusCode / 100);
        if ($statusCodeType == 4 || $statusCodeType == 5) {
            $mainController = new MainController();
            $this->pageParams["content"] = $mainController->errorAction($statusCode);
        }
    }

    /**
     * Метод підгружає теми. Основна тема знаходиться за шляхом themes/light/layout.php
     *
     * @return [type]
     * 
     */
    public function Done()
    {
        $pathToLayout = "themes/light/layout.php";
        $tpl = new Template($pathToLayout);
        $tpl->setParams($this->pageParams);
        $html = $tpl->getHTML();
        echo $html;
    }
}
