<?php

namespace controllers;

use core\Controller;

/**
 * Контроллер основної сторінки сайту
 */
class MainController extends Controller
{
    /**
     * Метод index
     *
     * @return [type]
     * 
     */
    public function indexAction()
    {
        return $this->render();
    }

    /**
     * Метод викликає помилку у разі її виникнення
     *
     * @param mixed $code
     * 
     * @return [type]
     * 
     */
    public function errorAction($code)
    {
        switch($code)
        {
            case 404:
                return $this->render("views/main/error-404.php");
                break;
            case 403:
                return $this->render("views/main/error-403.php");
                break;
        }
    }
}


