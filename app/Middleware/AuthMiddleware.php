<?php

namespace App\Middleware;

use App\Kernel\Miidleware\AbstractMiddleware;

class AuthMiddleware extends AbstractMiddleware
{


    public function handle(): void
    {

        if (!  $this->auth->check()) //если я не зареган отправляю на регистрацию
        {
            $this->redirect->to('/login');
        }
    }
}