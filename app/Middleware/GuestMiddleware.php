<?php

namespace App\Middleware;

use App\Kernel\Miidleware\AbstractMiddleware;

class GuestMiddleware extends AbstractMiddleware
{

    public function handle(): void
    {
        if ($this->auth->check()) // если авторизован не пройти на login и register
        {
            $this->redirect->to('/');
        }
    }
}