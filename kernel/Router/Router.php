<?php

namespace App\Kernel\Router;

use App\Http\RedirectInterface;
use App\Http\RequestInterface;
use App\Kernel\Auth\AuthInterface;
use App\Kernel\Config\ConfigInterface;
use App\Kernel\Controller\Controller;
use App\Kernel\DataBase\DataBaseInterface;
use App\Kernel\Log\Log;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\ViewInterface;

class Router implements RouterInterface
{
    public function __construct(
        private ViewInterface $view,
        private RequestInterface $request,
        private RedirectInterface $redirect,
        private SessionInterface $session,
        private DataBaseInterface $dataBase,
        private AuthInterface $auth,
    )
    {

        $this->initWebs(); // раскидываю каждый полученный роут в массив WEBS

    }

    //$uri - значение страницы на которой находишься
    //$method - значение метода попадания на страницу
    public function dispatch(string $uri, string $method): void
    //метод dispatch нужен для того чтобы определить контроллер и какой у него метод вызвать
    {
        $web = $this->findWeb($uri, $method);
        if (! $web ) {
            $this->notFound();
        }

        if (is_array($web->getAction()))// проверяю action в route(getAction) (с web.php) передан в виде массива
        {
            //$controller = $web->getAction()[0];
            /** @var Controller $controller */
            [$controller, $action] = $web->getAction();//переопределяю на путь до контроллера и на метод в контроллере
            $controller = new $controller(); //создал контроллер, все контроллеры наследуют от абстрактного контроллера

            /* call_user_func([$controller,'setView'],$this->view);*/
            $controller->setView($this->view); //
            $controller->setRequest($this->request);
            $controller->setRedirect($this->redirect);
            $controller->setSession($this->session);
            $controller->setDataBase($this->dataBase);
            $controller->setAuth($this->auth);

            call_user_func([$controller,$action]);
        }
        else{
            //$web->getAction()();
            call_user_func($web->getAction());
        }
    }

    private function getWebs(): array // с массива получаю список роутов
    {
        return require MAIN_PATH.'/config/web.php';
    }


    private array $webs = [
        'GET' => [],
        'POST' => [],
    ];


    //раскидываю роуты по их методу и помещаю в массив с возможными методами👆
    private function initWebs(): void
    {
        $webs = $this->getWebs(); //
        foreach ($webs as $web) {
            /** @var $web Route */
            $this->webs[$web->getMethod()][$web->getUri()] = $web; //закидываю в массив WEBS каждый роут(web.php) в свой method
        }
    }

    //из массива методов попадения на страницу
    private function findWeb(string $uri, string $method): Route|false
    {
        //проверка существования такой страницы и метод
        if (! isset($this->webs[$method][$uri])) { // страница не существует
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
