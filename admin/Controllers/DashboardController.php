<?php

namespace admin\Controllers;

use src\DI\DI;
use src\Exceptions\DIContainerException;
use src\Model;

class DashboardController extends AdminController
{
    /**
     * @var Model
     */
    protected $userModel;

    /**
     * DashboardController constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->userModel = $this->loader->model('user');
    }

    public function index()
    {
        $this->view->render('dashboard');
    }
}