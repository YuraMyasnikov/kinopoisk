<?php

namespace App\Kernel\Router;

class  Route //
{
    private string $uri;

    private string $method;

    private mixed $action;

    private array $middlewares = [];

    public function __construct(string $uri, string $method, $action, array $middlewares)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->action = $action;
        $this->middlewares = $middlewares;

    }


    public static function get(string $uri, $action, array $middlewares = []): static
    {
        return new static($uri,'GET',$action, $middlewares);
    }

    public static function post(string $uri, $action, array $middlewares = []): static
    {
        return new static($uri,'POST',$action, $middlewares);
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getAction(): mixed
    {
        return $this->action;
    }

    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }

    public function hasMiddlewares(): bool
    {
        return ! empty($this->middlewares);
    }
}
