<?php

namespace src\Core\Template;

class Theme
{
    const FILE_NAME_RULES = [
        'header' => 'header-%s',
        'sidebar' => 'sidebar-%s',
        'footer' => 'footer-%s',
        'scripts' => 'scripts-%s',
    ];

    /**
     * Url of the current theme
     * @var string 
     */
    public string $url = '';

    /**
     * @var array
     */
    protected array $data = [];

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @param string $name
     */
    public function header(string $name = '')
    {
        $file = (!empty($name)) ? sprintf(self::FILE_NAME_RULES['header'], $name) : 'header';

        try {
            $this->loadTemplateFile($file);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    /**
     * @param string $name
     */
    public function sidebar(string $name = '')
    {
        $file = (!empty($name)) ? sprintf(self::FILE_NAME_RULES['sidebar'], $name) : 'sidebar';

        try {
            $this->loadTemplateFile($file);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function scripts(string $name = '')
    {
        $file = (!empty($name)) ? sprintf(self::FILE_NAME_RULES['scripts'], $name) : 'scripts';

        try {
            $this->loadTemplateFile($file);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    /**
     * @param string $name
     */
    public function footer(string $name = '')
    {
        $file = (!empty($name)) ? sprintf(self::FILE_NAME_RULES['footer'], $name) : 'footer';

        try {
            $this->loadTemplateFile($file);
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    public function block(string $name = '', array $data = [])
    {
//        $file = (!empty($name)) ? sprintf(self::FILE_NAME_RULES['footer'], $name) : 'footer';
//
//        try {
//            $this->loadTemplateFile($file);
//        } catch (\Exception $e) {
//            echo $e->getMessage();
//            exit();
//        }
    }

    /**
     * @param string $fileName
     * @param array $data
     * @throws \Exception
     */
    private function loadTemplateFile(string $fileName, array $data = [])
    {
        $file = ROOT . '/../content/themes/default/' . $fileName . '.php';

        if (ENV === 'admin') {
            $file = ROOT . '/../admin/Views/' . $fileName . '.php';
        }

        if (!is_file($file)) {
            throw new \Exception(sprintf('View file %s does not exist', $file));
        }

        extract($data);
        require_once $file;
    }
}