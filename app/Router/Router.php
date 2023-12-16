<?php

namespace App\Router;

class Router
{
    public function __construct()
    {
        $this->initWebs();
    }

    //$uri - значение после доменного имени
    public function despatch(string $uri, string $method): void //[en] despatch - [ru] отправка
    {
        $webs = $this->findWeb($uri, $method);
        if (! $webs) {
            $this->notFound();
        }
        $webs->getAction()();
    }

    private function getWebs(): array
    {
        return require MAIN_PATH.'/config/web.php';
    }

    private array $webs = [
        'GET' => [],
        'POST' => [],
    ];

    private function initWebs(): void
    {
        $webs = $this->getWebs();
        foreach ($webs as $web) {
            /** @var $web Route */
            $this->webs[$web->getMethod()][$web->getUri()] = $web;
        }
    }

    private function findWeb(string $uri, string $method): Route|false
    {

        if (! isset($this->webs[$method][$uri])) {
            return false;
        }

        return $this->webs[$method][$uri];
    }

    private function notFound(): void
    {
        echo '404 | Not Found';
        exit();
    }
}
