<?php

namespace src\DI;

class DI
{
    /**
     * @var array
     */
    private $container = [];

    /**
     * @param string $key
     * @param $value
     * @return $this
     */
    public function set(string $key, $value): self
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->has($key) ? $this->container[$key] : null;
    }

    /**
     * @param string $key
     * @return bool
     */
    private function has(string $key): bool
    {
        return isset($this->container[$key]);
    }
}