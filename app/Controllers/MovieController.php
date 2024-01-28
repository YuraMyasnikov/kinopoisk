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
        //с формы отправляется значение инпутов сюда ($this->request()->post)

        // 1 отправляю на проверку полученые данные с формы
       $validations = $this->request()->validate([
           'name' => ['required', 'min:3', 'max:10']
       ]);

       //2 если в момент проаверки найдены ошибки т.е $validations == false
       if (! $validations)
       {
           //3 обходим массив с ошибками
           foreach ($this->request()->errors() as $nameInput => $error)
           {
               //4 помещаю в сессию каждую ошибку
               $this->session()->set($nameInput,$error);
           }
           // (далее в вьюхе)

           $this->redirect('/admin/movie/add');
       }

            $id = $this->db()->insert('movies',[
                'name' => $this->request()->input('name')
                ]);

            $this->redirect('/admin/movie/add');
    }

}