<?php

namespace cms\Controllers;

use src\Controller;
use src\DI\DI;

class CmsController extends Controller
{
    /**
     * CmsController constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        parent::__construct($di);
    }

    public function header()
    {
        
    }
}