<?php

namespace cms\Controllers;

class HomeController extends CmsController
{
    /**
     * Index method
     */
    public function index()
    {
        $this->view->render('index');
    }
}