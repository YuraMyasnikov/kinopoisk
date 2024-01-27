<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function addFormView(): void
    {
        $this->view('admin/movie/add');
    }
    public function addMovie(): void
    {

       $validations = $this->request()->validate([
           'name' => ['required', 'min:3', 'max:10']
       ]);

       if (! $validations)
       {
           foreach ($this->request()->errors() as $nameInput => $error)
           {
               $this->session()->set($nameInput,$error);
           }

           $this->redirect('/admin/movie/add');
       }

            $id = $this->db()->insert('movies',[
                'name' => $this->request()->input('name')
                ]);

            $this->redirect('/admin/movie/add');
    }

}