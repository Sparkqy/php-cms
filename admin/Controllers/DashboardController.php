<?php

namespace admin\Controllers;

class DashboardController extends AdminController
{
    public function index()
    {
        $this->view->render('dashboard');
    }
}