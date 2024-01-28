<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class RegisterController extends Controller
{
    public function index()
    {
        $this->view('register');

    }

    public function register()
    {
        $validations = $this->request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required', "min:2", "max:10"]
        ]);

      if (! $validations)
      {
          foreach ($this->request()->errors() as $name => $error)
          {
              $this->session()->set($name,$error);
          }
      }

      $userId = $this->db()->insert('users',[
          'email' => $this->request()->input('email'),
          'password' => password_hash( $this->request()->input('password'), PASSWORD_DEFAULT)
          ]);

        $this->redirect('/register');

    }
}