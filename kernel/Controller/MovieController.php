<?php

namespace App\Kernel\Controller;

class MovieController
{
    public function index(): void
    {
        include_once MAIN_PATH.'/view/pages/movies.php';
    }
}