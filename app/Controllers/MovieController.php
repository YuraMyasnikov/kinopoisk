<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class MovieController extends Controller
{
    public function index(): void
    {
        $this->view('movies');
    }

    public function addFormView(): void //отображение страны с формой
    {
        $this->view('admin/movie/add');
    }
    public function addMovie(): void
    {

       $validations = $this->request()->validate([
           'name_movie' => ['require', 'min:3', 'max:10'] // !!!!! НЕ ОТОБРАЖАЕТ REQUIRE ШО ЗА ХУЙНЯ НЕ ПОНЯЛ
       ]);

       if (! $validations)
       {

           foreach ($this->request()->errors() as $nameInput => $error)
           {
               $this->session()->set($nameInput,$error);
           }

           $this->redirect('/admin/movie/add');
       }

        /*dd('ok bratok');*/
        $this->redirect('/admin/movie/add');

    }
}