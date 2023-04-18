<?php

namespace core;

class Template
{ 
    protected $path;
    protected $params;
    public function __construct($path)
    {
        $this->path = $path;
        $this->params = [];
    }

    public function setParam($name, $value)
    {
        $this->params[$name] = $value;
    }

    public function setParams($params)
    {
        foreach($params as $name => $value)
            $this->setParam($name, $value);
    }

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