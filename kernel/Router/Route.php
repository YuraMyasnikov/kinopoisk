<?php

namespace App\Kernel\Router;

class  Route //
{
    private string $uri;

    private string $method;

    private mixed $action;

    public function __construct(string $uri, string $method, $action)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->action = $action;
    }


    public static function get(string $uri, $action): static
    {
        return new static($uri,'GET',$action);
    }

    public static function post(string $uri, $action): static
    {
        return new static($uri,'POST',$action);
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
}
