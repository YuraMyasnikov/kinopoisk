<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Kernel\Storage\Storage;
use App\Kernel\Upload\UploadedFileInterface;
use App\Movies\Movies;

class MovieController extends Controller
{
    public function index(): void
    {
        $movies = new Movies($this->db(),$this->storage());

        $this->view('movies', [
            'course' => [
                'usd' => 1,
                'eur' => 2,
            ],
            'date' => date('Y-m-d H:i:s'),
            'movies' => $movies->getList(),
            'porno' => $movies->getList(),
            'shorts' => []
        ]);
    }

    public function addFormView(): void
    {
        $this->view('admin/movie/add');
    }
    public function addMovie(): void
    {

        $path = $this->request()->file('image');
//        dd($path->move('default'));
        $filename = $path->move('movie');

        $url = $this->storage()->url($filename);

        //с формы отправляется значение инпутов сюда ($this->request()->post)

        // 1 отправляю на проверку полученые данные с формы
       $validations = $this->request()->validate([
           'name' => ['required', 'min:3', 'max:50']
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
            'name' => $this->request()->input('name'),
            'image' => $filename
        ]);

        $this->redirect('/admin/movie/add');
    }

}