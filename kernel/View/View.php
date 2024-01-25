<?php

namespace App\Kernel\View;



use App\Kernel\Exections\ViewNotFoundExection;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;

class View implements ViewInterface
{
    public function __construct(
        private SessionInterface $session
    ){}

    public function page ($name): void
    {
        $viewPath = MAIN_PATH . "/view/pages/$name.php";

        if (! file_exists($viewPath)) // проверка существует ли такой файл который с контроллера хочу открыть
        {
            throw new ViewNotFoundExection("Братан такой страницы \"$name\" не существует "); //ошибка на случай если с контроллера отправка на несуществующую страницу
        }

        extract(array: $this->defaultData()); // передаю в вьюху объекты классов

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

        include_once $filePath;
    }

    private function defaultData(): array
    {
        return [
            "view" => $this,
            'session' => $this->session,
        ];
    }
}