<?php

namespace core;

/**
 * Основний контроллер, батько всіх контроллерів.
 */
class Controller
{
    /**
     * Шлях до файлу з HTML-кодом, для рендерінгу
     *
     * @var string
     */
    protected $viewPath;

    /**
     * Назва контролеру
     *
     * @var string
     */
    protected $moduleName;
    /**
     * Назва методу контролера
     *
     * @var string
     */
    protected $actionName;

    /**
     * Конструктор класу, утворює шлях до файлу папки views, який відповідає за дизайн сторінки
     *
     */
    public function __construct()
    {
        $this->moduleName = \core\Core::getInstance()->app["moduleName"];
        $this->actionName = \core\Core::getInstance()->app["actionName"];
        $this->viewPath = "views/{$this->moduleName}/{$this->actionName}.php";
    }

    /**
     * Рендерінг сторінки сайту.
     * За замовчуванням шукатиметься файл views/Назва_Контроллера/Назва методу.php
     *
     * @param null $viewPath
     * @param null $params
     * 
     * @return [type]
     * 
     */
    public function render($viewPath = null, $params = null)
    {
        if (empty($viewPath))
            $viewPath = $this->viewPath;
        $tpl = new Template($viewPath);

        if (!empty($params))
            $tpl->setParams($params);

        return $tpl->getHTML();
    }

    public function redirect($url)
    {
        header("Location: $url");
        die;
    }

    public function renderView($viewName)
    {
        $viewPath = "views/$this->moduleName/$viewName.php";
        $tpl = new Template($viewPath);

        if (!empty($params))
            $tpl->setParams($params);

        return $tpl->getHTML();
    }

    public function renderPage($pageArrayProp, $params = null)
    {
        $viewPath = "views/$this->moduleName/sites/" . 
        $pageArrayProp['projectId'] . "/" . 
        $pageArrayProp['pageId'] . "/" . "index.php";

        $tpl = new Template($viewPath);

        if (!empty($params))
            $tpl->setParams($params);

        return $tpl->getHTML();
    }
    
    public function error($code, $message = null)
    {
        return new Error($code, $message);
    }
}
