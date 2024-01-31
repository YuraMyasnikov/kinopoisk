<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index()
    {
        $this->view('login');
    }

    public function login()
    {

        $email = $this->request()->input('email');          //email - только значение
        $password = $this->request()->input('password');


         $this->auth()->attempt($email,$password);

         $this->redirect('/movies');
    }

    public function logout()
    {
        $this->auth()->logout();

        $this->redirect('/login');
    }
}