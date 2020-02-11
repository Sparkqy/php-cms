<?php

namespace src\Services\View;

use src\Core\Template\View;
use src\Exceptions\DIContainerException;
use src\Services\AbstractProvider;

class ViewProvider extends AbstractProvider
{
    /**
     * @var string
     */
    const SERVICE_NAME = 'view';

    /**
     * @throws DIContainerException
     */
    public function init(): void
    {
        $view = new View();
        $this->di->set(self::SERVICE_NAME, $view);
    }
}