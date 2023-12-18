<?php

namespace App;

use App\Router\Router;

class App
{
    public function run(): void
    {
        //значение после доменного имени
        $uri = $_SERVER['REQUEST_URI'];
        //значение метода при входе на страницу
        $method = $_SERVER['REQUEST_METHOD'];

        $router = new Router();

        //метод обработки маршрута
        $router->despatch($uri, $method);
    }
}
