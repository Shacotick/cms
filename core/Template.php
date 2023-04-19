<?php

namespace core;

/**
 * [Description Template]
 */
class Template
{ 
    /**
     * [Description for $path]
     *
     * @var [type]
     */
    protected $path;

    /**
     * [Description for $params]
     *
     * @var [type]
     */
    protected $params;

    /**
     * [Description for __construct]
     *
     * @param mixed $path
     * 
     */
    public function __construct($path)
    {
        $this->path = $path;
        $this->params = [];
    }

    /**
     * [Description for setParam]
     *
     * @param mixed $name
     * @param mixed $value
     * 
     * @return [type]
     * 
     */
    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    /**
     * [Description for setParams]
     *
     * @param mixed $params
     * 
     * @return [type]
     * 
     */
    public function setParams($params)
    {
        foreach($params as $name => $value)
            $this->setParam($name, $value);
    }

    /**
     * [Description for getHTML]
     *
     * @return [type]
     * 
     */
    public function getHTML()
    {
        ob_start();                 // закидаємо весь хтмл код в буфер
        extract($this->params);           // важка хуйня, краще погугли чи https://youtu.be/AOMS9lJObiA?list=PLqKuDFs5Nd3K3OpZ2lAsMwJSDi-Oh8myI&t=3823
        include($this->path);
        $html = ob_get_contents();  // зберігаємо дані з буферу
        ob_end_clean();             // закриваємо буфер та очищуємо його
        return $html;
    }
}