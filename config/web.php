<?php

use App\Controller\HomeController;
use App\Controller\IndexController;
use App\Router\Route;

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
