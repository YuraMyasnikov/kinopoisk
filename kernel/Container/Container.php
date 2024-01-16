<?php

namespace App\Kernel\Container;

use App\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\View\View;

class Container
{

    public readonly Request $request;
    public readonly Router $router;
    public readonly View $view;

    public function __construct()
    {
        $this->services();
    }

    private function services (): void
    {
        $this->request = Request::findGlobal(); //статический метод инициализирует глобальные переменные GET POST SERVER FILES COOKIES
        $this->view = new View();
        $this->router = new Router($this->view);
    }

}