<?php

namespace src\Core\Template;

class View
{
    /**
     * @var \src\Core\Template\Theme
     */
    protected $theme;

    public function __construct()
    {
        $this->theme = new Theme();
    }

    /**
     * @param string $template
     * @param array $vars
     */
    public function render(string $template, array $vars = [])
    {
        $templatePath = $this->getTemplatePath($template, ENV);

        if (!is_file($templatePath)) {
            throw new \InvalidArgumentException(
                sprintf('Template "%s" not found in "%s"!', $template, $templatePath)
            );
        }

        $this->theme->setData($vars);
        extract($vars);
        ob_start();
        ob_implicit_flush(0);
        require $templatePath;
        echo ob_get_clean();
    }

    /**
     * @param string $template
     * @param string|null $env
     * @return string
     */
    private function getTemplatePath(string $template, string $env = null): string
    {
        if ($env === 'cms') {
            return $_SERVER['DOCUMENT_ROOT'] . '/../content/themes/default/' . $template . '.php';
        }

        return $_SERVER['DOCUMENT_ROOT'] . '/../admin/Views/' . $template . '.php';
    }
}