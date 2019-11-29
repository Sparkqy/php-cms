<?php

namespace admin\Controllers;

use src\Controller;
use src\Core\Router\Router;
use src\DI\DI;
use src\Core\Auth\Auth;
use src\Helpers\Url;

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

        if (!$this->auth->isAuthorized() && $this->request->server['REQUEST_URI'] !== '/admin/login') {
            // redirect to /admin/login
            header('Location: /admin/login', true, 301);
            exit();
        }
    }
}