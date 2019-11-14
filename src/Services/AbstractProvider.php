<?php

namespace src\Services;

use src\DI\DI;

abstract class AbstractProvider
{
    /**
     * @var DI
     */
    protected $di;

    /**
     * AbstractProvider constructor.
     * @param DI $di
     */
    public function __construct(DI $di)
    {
        $this->di = $di;
    }

    abstract public function init(): void;
}