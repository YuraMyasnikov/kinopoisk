<?php

namespace App\Kernel\Container;

use App\Http\Redirect;
use App\Http\RedirectInterface;
use App\Http\Request;
use App\Http\RequestInterface;
use App\Kernel\Auth\Auth;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Config\Config;
use App\Kernel\Config\ConfigInterface;
use App\Kernel\DataBase\DataBase;
use App\Kernel\DataBase\DataBaseInterface;
use App\Kernel\Log\Log;
use App\Kernel\Router\Router;
use App\Kernel\Router\RouterInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\Validator\ValadatorInterface;
use App\Kernel\Validator\Validator;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

class Container // инициализация классов из services отправляется в App.php
{

    public readonly RequestInterface $request;
    public readonly RouterInterface $router;

    public readonly ViewInterface $view;
    public readonly ValadatorInterface $validator;
    public readonly RedirectInterface $redirect;
    public readonly SessionInterface $session;
    public readonly ConfigInterface $config;
    public readonly DataBaseInterface $dataBase;
    public readonly AuthInterface $auth;



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
        $this->config = new Config();
        $this->dataBase = new DataBase($this->config);
        $this->auth = new Auth($this->dataBase, $this->session, $this->config);
        $this->view = new View($this->session,$this->auth); // -> в контроллер -> в нужный контроллер = сетим страницу которую открыть
        $this->router = new Router(
            $this->view,
            $this->request,
            $this->redirect,
            $this->session,
            $this->dataBase,
            $this->auth,
        ); //в конструктор роутера передаю значения какую страницу открывается и глобальные методы


    }

}