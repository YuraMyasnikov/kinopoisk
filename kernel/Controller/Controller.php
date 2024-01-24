<?php

namespace App\Kernel\Controller;

use App\Http\Request;
use App\Kernel\View\View;

abstract class Controller // им наследуют остальные контроллеры (батя)
{

    private View $view;
    private Request $request;

    public function request(): Request
    {
        return $this->request;
    }

    public function setRequest(Request $request): void
    {
        $this->request = $request;
    }

    public function view(string $name): void
    {
        $this->view->page($name);

    }

    public function setView(View $view): void
    {
        $this->view = $view;
    }


}