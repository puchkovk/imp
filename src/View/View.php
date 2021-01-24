<?php

declare(strict_types=1);

namespace TheImp\View;

class View implements ViewInterface
{
    protected const EXTENDS_DEPTH_MAX = 99;
    /**
     * @var mixed[]
     */
    private static array $globals = [];

    private ?string $extendsTemplate = null;

    private ?string $currentBlock = null;

    /**
     * @var string[]
     */
    private array $blocks = [];

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
        if ( !empty($params)) {
            $this->setParams($params);
        }

        $template = ltrim($template, '/');

        $systemTemplateFilename = $this->templateRoot . '/' . $template . '.php';
        unset ($template);
        if (!file_exists($systemTemplateFilename)) {
            throw new ViewException('Template ' . $systemTemplateFilename . ' not found');
        }

        ob_start();
        extract($this->params);
        include $systemTemplateFilename;
        $systemExtendsDepthIterator = 0;
        while ($this->extendsTemplate !== null && $systemExtendsDepthIterator < self::EXTENDS_DEPTH_MAX) {
            $extendsTemplateFilename = $this->templateRoot . '/' . $this->extendsTemplate . '.php';
            $this->extendsTemplate = null;
            if ( !file_exists($extendsTemplateFilename)) {
                throw new ViewException('Template ' . $extendsTemplateFilename . ' not found');
            }
            $systemExtendsDepthIterator++;
            include $extendsTemplateFilename;
        }

        return (string) ob_get_clean();
    }

    public function extends(string $templateName): void
    {
        if (null !== $this->extendsTemplate) {
            throw new ViewException('Unexpected extends method call');
        }

        $this->extendsTemplate = $templateName;
    }

    public function block(string $blockName): void
    {
        if (null !== $this->currentBlock) {
            throw new ViewException('Unexpected block start');
        }
        $this->currentBlock = $blockName;
        ob_start();
    }

    public function blockEnd(): void
    {
        if (null === $this->currentBlock) {
            throw new ViewException('Unexpected block end');
        }

        if (isset($this->blocks[$this->currentBlock])) {
            $blockOutput = $this->blocks[$this->currentBlock];
            ob_end_clean();
        } else {
            $blockOutput = (string) ob_get_clean();
        }

        if (null !== $this->extendsTemplate) {
            $this->blocks[$this->currentBlock] = $blockOutput;
        } else {
            echo $blockOutput;
        }

        $this->currentBlock = null;
    }
}
