<?php

namespace App\Kernel;

use App\Kernel\Container\Container;


class App //содержит метод run который выводится при попадании на сайт
{
    private Container $container;


    public function __construct()
    {
        $this->container = new Container(); //Инициализирую container в котором в конструкторе сразу выводит метод services в котором инициализируются методы request|router|view
    }

    public function run(): void
    {

        $uri = $this->container->request->uri();        // на какой странице сейчас нахожусь (уже с отрезанным ?)
        $method = $this->container->request->method();  // каким методом попал на страницу

        $this->container->router->dispatch($uri,$method);

    }
}
