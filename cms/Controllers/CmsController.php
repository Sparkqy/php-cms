<?php

namespace cms\Controllers;

use src\Controller;
use src\DI\DI;
use src\Exceptions\DIContainerException;

class CmsController extends Controller
{
    /**
     * CmsController constructor.
     * @param DI $di
     * @throws DIContainerException
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
    }

    public function header()
    {
        
    }
}