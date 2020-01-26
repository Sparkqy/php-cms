<?php

namespace src\Services\Load;

use src\Exceptions\DIContainerException;
use src\Load;
use src\Services\AbstractProvider;

class LoadProvider extends AbstractProvider
{
    /**
     * @var string
     */
    const SERVICE_NAME = 'loader';

    /**
     * @throws DIContainerException
     */
    public function init(): void
    {
        $loader = new Load($this->di);
        $this->di->set(self::SERVICE_NAME, $loader);
    }
}