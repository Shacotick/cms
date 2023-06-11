<?php

namespace core;

/**
 * [Description Template]
 */
class Template
{ 
    /**
     * Шлях до шаблону сторінки
     *
     * @var [type]
     */
    protected $path;

    /**
     * Асоціативний масив параметрів, які потенційно можуть використовуватись в сторінці.
     * Наприклад, cms/user/index/2, де 2 - параметр
     *
     * @var [type]
     */
    protected $params;

    /**
     * Конструктор класу. Задає початкові значення для path і params
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
     * Добавляє до асоціативного масиву params значення по ключу
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
     * Добавляє до асоціативного масиву params масив значеннь по ключу
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
     * Повертає HTML-код шаблону сторінки
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