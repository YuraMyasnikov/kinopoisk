<?php

namespace App\Kernel\Container;

use App\Http\Redirect;
use App\Http\Request;
use App\Kernel\Router\Router;
use App\Kernel\Session\Session;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;

class Container // инициализация классов из services отправляется в App.php
{

    public readonly Request $request;
    public readonly Router $router;

    public readonly View $view;
    public readonly Validator $validator;
    public readonly Redirect $redirect;
    public readonly Session $session;

    public function __construct()
    {
        $this->services();
    }

    private function services (): void
    {
        $this->request = Request::findGlobal(); //статический метод инициализирует глобальные переменные GET POST SERVER FILES COOKIES
        $this->validator = new Validator(); // -> передается в request
        $this->request->setValidator($this->validator);
        $this->redirect = new Redirect();
        $this->session = new Session();
        $this->view = new View($this->session); // -> в контроллер -> в нужный контроллер = сетим страницу которую открыть
        $this->router = new Router($this->view,$this->request,$this->redirect, $this->session); //в конструктор роутера передаю значения какую страницу открывается и глобальные методы


    }

}