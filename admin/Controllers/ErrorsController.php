<?php

namespace admin\Controllers;

class ErrorsController extends AdminController
{
    public function show404()
    {
        $this->view->render('errors/404');
    }
}