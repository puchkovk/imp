<?php

declare(strict_types=1);

namespace TheImp\Controller;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class AbstractController
{
    /**
     * @var array<mixed>
     */
    protected array $query;

    /**
     * @var mixed[]
     */
    protected array $body;

    protected ResponseInterface $response;

    abstract protected function run(): ResponseInterface;

    protected function before(): void
    {

    }

    protected function after(): void
    {

    }

    final public function __invoke(ServerRequestInterface $request) : ResponseInterface
    {
        $this->query = $request->getQueryParams();
        $this->body  = (array) ($request->getParsedBody() ?? []);

        $this->before();
        $this->response = $this->run();
        $this->after();
        return $this->response;
    }

    /**
     * @return mixed[]
     */
    protected function getQueryParams(): array
    {
        return $this->query;
    }

    /**
     * @param string $key
     * @param mixed|null $default
     *
     * @return mixed[]
     *
     */
    protected function getQueryParam(string $key, $default = null): array
    {
        return $this->query[$key] ?? $default;
    }

    /**
     * @return mixed
     */
    protected function getParsedBody()
    {
        return $this->body ?? null;
    }
}
