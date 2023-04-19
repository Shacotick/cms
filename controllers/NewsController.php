<?php

namespace controllers;

use core\Controller;
use core\Template;

/**
 * [Description NewsController]
 */
class NewsController extends Controller
{   
    /**
     * [Description for __construct]
     *
     * 
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * [Description for viewAction]
     *
     * @return [type]
     * 
     */
    public function viewAction()
    {
        return $this->render();
    }

    /**
     * [Description for indexAction]
     *
     * @return [type]
     * 
     */
    public function indexAction()
    {
        return $this->render();
    }
}