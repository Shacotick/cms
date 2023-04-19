<?php

namespace controllers;

use core\Controller;

/**
 * [Description UserController]
 */
class UserController extends Controller
{
    /**
     * [Description for indexAction]
     *
     * @return [type]
     * 
     */
    public function indexAction()
    {
        return $this->render(null, [
            "indexUser" => "Index User"
        ]);
    }
}