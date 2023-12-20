<?php

namespace App\Kernel\Router;

class Router
{
    public function __construct()
    {
        //по умолчанию раскидываю роуты в массив с методами
        $this->initWebs();
    }

    //$uri - значение после доменного имени
    public function dispatch(string $uri, string $method): void //[en] dispatch - [ru] диспетчер
    {
        $web = $this->findWeb($uri, $method);
        if (! $web ) {
            $this->notFound();
        }

        if (is_array($web->getAction()))
        {

            //$controller = $web->getAction()[0];
            [$controller, $action] = $web->getAction();
            $controller = new $controller();
            $controller->$action();
        }
        else{
            //$web->getAction()();
            call_user_func($web->getAction());
        }


    }

    //получаю массив моих роутов
    private function getWebs(): array
    {
        return require MAIN_PATH.'/config/web.php';
    }

    //формированые по методам роуты
    private array $webs = [
        'GET' => [],
        'POST' => [],
    ];

    //раскидываю роуты по их методу и помещаю в массив с возможными методами👆
    private function initWebs(): void
    {
        $webs = $this->getWebs();
        foreach ($webs as $web) {
            /** @var $web Route */
            $this->webs[$web->getMethod()][$web->getUri()] = $web;
        }
    }

    //из массива методов попадения на страницу
    private function findWeb(string $uri, string $method): Route|false
    {
        //проверка существования такой страницы и метод
        if (! isset($this->webs[$method][$uri])) {
            return false;
        }
        //возвращаю страницу с таким методом
        return $this->webs[$method][$uri];
    }

    private function notFound(): void
    {
        echo '404 | Not Found';
        exit();
    }
}
