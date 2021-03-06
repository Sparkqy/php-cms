<?php

namespace admin\Controllers;

use src\Controller;
use src\DI\DI;
use src\Core\Auth\Auth;
use src\Exceptions\DIContainerException;
use src\Helpers\Url;

class AdminController extends Controller
{
    /**
     * @var Auth
     */
    protected Auth $auth;

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * AdminController constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
        $this->auth = new Auth();

        if ($this->auth->userHash() === null) {
            Url::redirect('/admin/login');
        }
    }

    /**
     * @return void
     */
    public function checkAuth(): void
    {
        if ($this->auth->userHash() !== null) {
            $this->auth->authorize($this->auth->userHash());
        }

        if (!$this->auth->isAuthorized()) {
            Url::redirect('/admin/login');
        }
    }
}