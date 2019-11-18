<?php

namespace cms\Controllers;

class HomeController extends CmsController
{
    /**
     * Index method
     */
    public function index()
    {
        $data = ['name' => 'Sparkqy'];
        $this->view->render('index', $data);
    }
}