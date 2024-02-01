<?php

namespace App\Kernel\Miidleware;

interface MiddlewareInterface
{

    public function check (array $middleware = []): void;

}