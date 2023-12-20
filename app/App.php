<?php

namespace App;

use App\Http\Request;
use App\Router\Router;


class App
{
    public function run(): void
    {
        //получение массив всего реквеста
        $request = Request::findGlobal();
        //значение после доменного имени
        $uri = $request->uri();
        //значение метода при входе на страницу
        $method = $request->method();

        $router = new Router();
        //метод обработки маршрута
        $router->dispatch($uri, $method);
    }
}
