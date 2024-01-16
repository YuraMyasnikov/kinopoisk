<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\View\View;

class IndexController extends Controller
{
    public function index(): void
    {
        $this->view('index');
    }
}