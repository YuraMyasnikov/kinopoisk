<?php

use App\Controllers\HomeController;
use App\Controllers\IndexController;
use App\Controllers\MovieController;
use App\Kernel\Router\Route;

return [

    Route::get('/', [IndexController::class,'index']),
    Route::get('/home',function () {
        include_once MAIN_PATH.'/view/pages/home.php';
    }),
    Route::get('/movies',[MovieController::class,'index']),

    Route::get('/admin/movie/add', [MovieController::class,'addFormView']),
    Route::post('/admin/movie/add', [MovieController::class,'addMovie']),

];
