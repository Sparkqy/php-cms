<?php

namespace admin\Controllers\Auth;

use src\Controller;
use src\Core\Auth\Auth;
use src\DI\DI;

class LogoutController extends Controller
{
    /**
     * @var Auth
     */
    protected $auth;

    /**
     * LogoutController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);

        $this->auth = new Auth();
    }

    public function logout()
    {
        $this->auth->unauthorize();

        header('Location: /');
        exit();
    }
}