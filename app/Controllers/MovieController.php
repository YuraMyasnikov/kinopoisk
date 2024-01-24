<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
/*use App\Kernel\Validator\Validator;
use App\Kernel\View\View;*/

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
        /*$data = [
            'name_movie' => 'spider man',
            'janre_movie' => 'film'
            ];
        $rules = [
            'name_movie' => ['required', 'min:3', 'max:15'],
            'janre_movie' => ['required', 'min:4', 'max:15']
        ];
        $validator = new Validator();
        dd($validator->validate($data, $rules), $validator->errors());
        $this->request();*/

       $validations = $this->request()->validate([
           'name_movie' => ['require', 'min:3', 'max:10']
       ]);

       if (! $validations)
       {
           dd( 'err' , $this->request()->errors());
       }

       dd('ok');

    }
}