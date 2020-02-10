<?php

namespace src\DI\Traits;

use src\DI\DI;
use src\Exceptions\DIContainerException;

trait InitDependenciesToProperties
{
    /**
     * @return $this
     * @throws DIContainerException
     */
    protected function initPropertiesFromDI(): self
    {
        $properties = array_keys(get_object_vars($this));
        /** @var DI $di */
        $di = $this->di;

        foreach ($properties as $property) {
            if ($di->has($property)) {
                $this->{$property} = $di->get($property);
            }
        }

        return $this;
    }
}