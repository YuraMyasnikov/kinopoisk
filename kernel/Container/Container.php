<?php

namespace App\Kernel\Container;

use App\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;

class Container // инициализация классов из services отправляется в App.php
{

    public readonly Request $request;
    public readonly Router $router;
    public readonly View $view;
    public readonly Validator $validator;

    public function __construct()
    {
        $this->services();
    }

    private function services (): void
    {
        $this->request = Request::findGlobal(); //статический метод инициализирует глобальные переменные GET POST SERVER FILES COOKIES
        $this->view = new View(); // -> в контроллер -> в нужный контроллер = сетим страницу которую открыть
        $this->router = new Router($this->view,$this->request); //в конструктор роутера передаю значения какую страницу открывается и глобальные методы
        $this->validator = new Validator(); // -> передается в request
        $this->request->setValidator($this->validator);
    }

}