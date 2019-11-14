<?php

namespace src;

use src\DI\DI;

class Controller
{
    /**
     * @var DI
     */
    private $di;

    public function __construct(DI $di)
    {
        $this->di = $di;
    }
}