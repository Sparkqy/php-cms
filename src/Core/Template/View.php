<?php

namespace src\Core\Template;

class View
{
    public function __construct()
    {

    }

    /**
     * @param string $template
     * @param array $vars
     */
    public function render(string $template, array $vars = [])
    {
        $templatePath = ROOT . '/content/themes/default/' . $template . '.php';

        if (!is_file($templatePath)) {
            throw new \InvalidArgumentException(
                sprintf('Template "%s" not found in "%s"!', $template, $templatePath)
            );
        }

        extract($vars);
        ob_start();
        ob_implicit_flush(0);
        require $templatePath;
        echo ob_get_clean();
    }
}