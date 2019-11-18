<?php

namespace src;

use src\Core\Database\Db;
use src\Core\Template\View;
use src\DI\DI;

class Controller
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
     * Controller constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->view = $this->di->get('view');
    }
}