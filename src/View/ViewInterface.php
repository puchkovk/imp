<?php

declare(strict_types=1);

namespace TheImp\View;

interface ViewInterface
{
    /**
     * @param string $name
     * @param mixed  $value
     *
     * @return void
     */
    public static function setGlobal(string $name, $value): void;

    /**
     * @param string $name
     * @param mixed  $value
     * @return $this
     */
    public function setParam(string $name, $value): self;

    /**
     * @param mixed[] $params
     * @return $this
     */
    public function setParams(array $params): self;

    /**
     * @param string  $template
     * @param mixed[] $params
     *
     * @return string
     */
    public function render(string $template, array $params): string;
}
