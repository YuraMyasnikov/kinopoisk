<?php

namespace App\Kernel\Container;

use App\Http\Request;
use App\Kernel\Router\Router;

class Container
{

    public readonly Request $request;
    public readonly Router $router;

    public function __construct()
    {
        $this->services();
    }

    private function services (): void
    {
        $this->request = Request::findGlobal();
        $this->router = new Router();
    }

}