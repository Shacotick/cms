<?php

namespace core;

/**
 * Основний контроллер, батько всіх контроллерів.
 */
class Controller
{ 
    /**
     * [Description for $viewPath]
     *
     * @var [type]
     */
    protected $viewPath;
    
    /**
     * [Description for __construct]
     *
     * 
     */
    public function __construct()
    {
        $moduleName = \core\Core::getInstance()->app["moduleName"];
        $actionName = \core\Core::getInstance()->app["actionName"];
        $this->viewPath = "views/{$moduleName}/{$actionName}.php";
    }

    /**
     * [Description for render]
     *
     * @param null $viewPath
     * @param null $params
     * 
     * @return [type]
     * 
     */
    public function render($viewPath = null, $params = null)
    {
        if(empty($viewPath))
            $viewPath = $this->viewPath;
        $tpl = new Template($viewPath);

        if(!empty($params))
            $tpl->setParams($params);
            
        return $tpl->getHTML();
    }
}