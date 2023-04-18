<?php

namespace core;

use controllers\MainController;

class Core
{
    private static $instance = null;
    public $app;

    private function __construct()
    {
        $this->app = [];
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function Initialize()
    {
    }

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

    public function Done()
    {
        $pathToLayout = "themes/light/layout.php";
        $tpl = new Template($pathToLayout);
        $tpl->setParam("content", $this->app["actionResult"]);
        $html = $tpl->getHTML();
        echo $html;
    }
}
