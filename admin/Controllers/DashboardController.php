<?php

namespace admin\Controllers;

use src\DI\DI;
use src\Exceptions\DIContainerException;

class DashboardController extends AdminController
{
    protected $userEntity;

    /**
     * DashboardController constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->userEntity = $this->loader->model('user');
    }

    public function index()
    {
        $this->view->render('dashboard');
    }
}