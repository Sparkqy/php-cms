<?php

namespace admin\Controllers\Auth;

use admin\Controllers\AdminController;

class LoginController extends AdminController
{
    public function index()
    {
        $this->view->render('auth/login');
    }
}