<?php

namespace src\Services\Request;

use src\Core\Request\Request;
use src\Services\AbstractProvider;

class RequestProvider extends AbstractProvider
{
    /**
     * @var string
     */
    const SERVICE_NAME = 'request';

    public function init(): void
    {
        $request = new Request();

        $this->di->set(self::SERVICE_NAME, $request);
    }
}