<?php

declare(strict_types=1);

namespace TheImp\Controller;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TheImp\View\ViewInterface;

abstract class TemplatedController extends AbstractController
{
    protected ViewInterface $view;

    private string $templateName;
    private int $statusCode = 200;

    public function __construct(ViewInterface $view, string $templateName)
    {
        $this->view = $view;
        $this->templateName = $templateName;
    }

    protected function useTemplate(string $templateName): self
    {
        $this->templateName = $templateName;

        return $this;
    }

    protected function run(): ResponseInterface
    {
        $variables = $this->action();

        //$body     = '<h2>Hello, world 8!</h2>' . var_export($this->shopRepository->getAll(), true);
        $response = new Response;
        //$template =
        $answer = $this->view->render($this->templateName, $variables);
        $response->getBody()->write($answer);
        return $response->withStatus($this->statusCode);
    }

    /**
     * @return mixed[]
     */
    abstract protected function action(): array;
}
