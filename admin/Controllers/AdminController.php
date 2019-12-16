<?php

namespace admin\Controllers;

use src\Controller;
use src\DI\DI;
use src\Core\Auth\Auth;

class AdminController extends Controller
{
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * AdminController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);

        $this->auth = new Auth();
//        $this->checkAuth();
        if (is_null($this->auth->userHash())) {
            header('Location: /admin/login');
            exit();
        }
    }

    /**
     * @return void
     */
    public function checkAuth(): void
    {
        if (!is_null($this->auth->userHash())) {
            $this->auth->authorize($this->auth->userHash());
        }

        if (!$this->auth->isAuthorized()) {
            header('Location: /admin/login', true, 301);
            exit();
        }
    }
}