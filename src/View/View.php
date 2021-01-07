<?php

declare(strict_types=1);

namespace TheImp\View;

class View implements ViewInterface
{
    /**
     * @var mixed[]
     */
    private static array $globals = [];

    /**
     * @var mixed[]
     */
    protected array $params = [];

    protected string $templateRoot;

    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    public static function setGlobal(string $name, $value): void
    {
        self::$globals[$name] = $value;
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public static function getGlobal(string $name, $default = null)
    {
        return self::$globals[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param mixed $value
     *
     * @return $this
     */
    public function setParam(string $name, $value): self
    {
        $this->params[$name] = $value;

        return $this;
    }

    public function setParams(array $params): ViewInterface
    {
        $this->params = array_merge($this->params, $params);

        return $this;
    }

    /**
     * @param string $name
     * @param mixed|null $default
     *
     * @return mixed|null
     */
    public function getParam(string $name, $default = null)
    {
        return $this->params[$name] ?? $default;
    }

    /**
     * @return mixed[]
     */
    public function getParams(): array
    {
        return $this->params;
    }

    public function setTemplateRoot(string $dir): self
    {
        $this->templateRoot = rtrim($dir, '/');

        return $this;
    }

    /**
     * @param string  $template
     * @param mixed[] $params
     *
     * @return string
     *
     * @throws ViewException
     */
    public function render(string $template, array $params = []): string
    {
        $template = ltrim($template, '/');

        $templateFilename = $this->templateRoot . '/' . $template . '.php';
        if ( !file_exists($templateFilename)) {
            throw new ViewException('Template ' . $templateFilename . ' not found');
        }

        ob_start();
        extract($this->params);
        include $templateFilename;

        return (string) ob_get_clean();
    }
}
