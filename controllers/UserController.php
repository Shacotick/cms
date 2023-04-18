<?php

namespace controllers;

use core\Controller;

class UserController extends Controller
{
    public function indexAction()
    {
        return $this->render(null, [
            "indexUser" => "Index User"
        ]);
    }
}