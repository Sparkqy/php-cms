<?php

namespace src;

use src\Core\Database\Db;
use src\Core\Request\Request;
use src\Core\Template\View;
use src\DI\DI;

abstract class Controller
{
    /**
     * @var DI
     */
    protected $di;

    /**
     * @var Db
     */
    protected $db;

    /**
     * @var View
     */
    protected $view;

    /**
     * @var array
     */
    protected $configs;

    /**
     * @var Request
     */
    protected $request;

    /**
     * Controller constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->view = $this->di->get('view');
        $this->configs = $this->di->get('config');
        $this->request = $this->di->get('request');
    }
}