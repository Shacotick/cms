<?php

namespace controllers;

/**
 * [Description MainController]
 */
class MainController
{
    /**
     * [Description for indexAction]
     *
     * @return [type]
     * 
     */
    public function indexAction()
    {
        echo "Main Page";
    }

    /**
     * [Description for errorAction]
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
                echo "Error 404. Not Found.";
                break;
        }
    }
}


