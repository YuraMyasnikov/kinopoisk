<?php

use App\Kernel\Controller\HomeController;
use App\Kernel\Controller\IndexController;
use App\Kernel\Router\Route;

return [

    Route::get('/', [IndexController::class,'index']),
    Route::get('/home',[HomeController::class,'index']),
    Route::get('/movies', function () {
        include_once MAIN_PATH.'/view/pages/movies.php';
    }),
    Route::post('/movies', function () {
        include_once MAIN_PATH.'/view/pages/movies.php';
    }),
];
