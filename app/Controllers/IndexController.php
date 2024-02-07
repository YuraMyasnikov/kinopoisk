<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class IndexController extends Controller
{
    public function index(): void
    {
        $img = MAIN_PATH . "/public/default/42f4cb9259c8d1fcf4ac80538d61bff6.jpg";

        $this->view('index');
    }
}