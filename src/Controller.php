<?php

namespace src;

use src\Core\Database\Db;
use src\Core\Request\Request;
use src\Core\Template\View;
use src\DI\DI;
use src\DI\Traits\InitDependenciesToProperties;
use src\Exceptions\DIContainerException;

abstract class Controller
{
    use InitDependenciesToProperties;

    /**
     * @var DI
     */
    protected DI $di;

    /**
     * @var Db
     */
    protected Db $db;

    /**
     * @var View
     */
    protected View $view;

    /**
     * @var array
     */
    protected array $configs;

    /**
     * @var Request
     */
    protected Request $request;

    /**
     * @var Load
     */
    protected Load $loader;

    /**
     * @param $name
     * @return mixed
     * @throws DIContainerException
     */
    public function __get($name)
    {
        return $this->di->get($name);
    }

    /**
     * Controller constructor.
     * @param DI $di
     * @throws Exceptions\DIContainerException
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
        $this->db = $this->di->get('db');
        $this->view = $this->di->get('view');
        $this->configs = $this->di->get('config');
        $this->request = $this->di->get('request');
        $this->loader = $this->di->get('loader');

        $this->initPropertiesFromDI();
    }
}