<?php

namespace App\Kernel\Controller;

class HomeController
{
    public function index(): void
    {
        include_once MAIN_PATH.'/view/pages/home.php';
    }
}