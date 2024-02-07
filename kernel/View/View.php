<?php

namespace App\Kernel\View;



use App\Kernel\Auth\AuthInterface;
use App\Kernel\Exections\ViewNotFoundExection;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session,
        private AuthInterface $auth
    ){}

    public function page ($name, array $data = []): void
    {
        $viewPath = MAIN_PATH . "/view/pages/$name.php";

        if (! file_exists($viewPath)) // проверка существует ли такой файл который с контроллера хочу открыть
        {
            throw new ViewNotFoundExection("Братан такой страницы \"$name\" не существует "); //ошибка на случай если с контроллера отправка на несуществующую страницу
        }

        extract(array: array_merge($this->defaultData(), ['data' => $data])); // передаю в вьюху объекты классов

        include_once $viewPath;
    }

    public function component ($name): void
    {
        $filePath = MAIN_PATH . "/view/components/$name.php";

        if (! file_exists($filePath))
        {
            echo "файл - $name отсутствует";
            return;
        }

        extract(array: $this->defaultData()); // передаю в вьюху объекты классов

        include_once $filePath;
    }

    private function defaultData(): array
    {
        return [
            "view" => $this,
            'session' => $this->session,
            'auth' => $this->auth,
        ];
    }
}