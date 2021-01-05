<?php

declare(strict_types=1);

namespace TheImp\Controller;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use TheImp\Exception\Http\{
    MovedPermanentlyException,
    NotFoundException,
    FoundException,
};
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

        $response = new Response;
        try {
            $answer = $this->view->render($this->templateName, $variables);
            $response->getBody()->write($answer);
            $response->withStatus(200);
        } catch (NotFoundException $notFoundException) {
            $response->getBody()->write('Not found');
            $response->withStatus($notFoundException->getCode());
        } catch (FoundException $movedPermanentlyException) {
            $response = new Response\RedirectResponse($movedPermanentlyException->getUrl(), $movedPermanentlyException->getCode());
            return $response;
        } catch (MovedPermanentlyException $movedPermanentlyException) {
            $response = new Response\RedirectResponse($movedPermanentlyException->getUrl(), $movedPermanentlyException->getCode());
            return $response;
        } catch (\Throwable $throwable) {
            $response->withStatus(500);
        }
        return $response;
    }

    /**
     * @return mixed[]
     */
    abstract protected function action(): array;
}
