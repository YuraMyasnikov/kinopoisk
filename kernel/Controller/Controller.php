<?php

namespace App\Kernel\Controller;

use App\Http\Redirect;
use App\Http\RedirectInterface;
use App\Http\Request;
use App\Http\RequestInterface;
use App\Kernel\DataBase\DataBaseInterface;
use App\Kernel\Session\Session;
use App\Kernel\Session\SessionInterface;
use App\Kernel\View\View;
use App\Kernel\View\ViewInterface;

abstract class Controller // им наследуют остальные контроллеры (батя)
{

    private ViewInterface $view;
    private RequestInterface $request;
    private  RedirectInterface $redirect;
    private  SessionInterface $session;
    private  DataBaseInterface $dataBase;


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

    public function setRedirect(Redirect $redirect): void
    {
        $this->redirect = $redirect;
    }

    public function redirect(string $uri): void
    {
         $this->redirect->to($uri);
    }

    public function session(): Session
    {
        return $this->session;
    }

    public function setSession(Session $session): void
    {
        $this->session = $session;
    }

    public function db(): DataBaseInterface
    {
        return $this->dataBase;
    }

    public function setDataBase(DataBaseInterface $dataBase): void
    {
        $this->dataBase = $dataBase;
    }
}