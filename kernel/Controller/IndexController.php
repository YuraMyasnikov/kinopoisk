<?php

namespace App\Kernel\Controller;

class IndexController
{
    public function index(): void
    {
        include_once MAIN_PATH.'/view/pages/index.php';
    }
}