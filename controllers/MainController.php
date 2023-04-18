<?php

namespace controllers;

class MainController
{
    public function indexAction()
    {
        echo "Main Page";
    }

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


