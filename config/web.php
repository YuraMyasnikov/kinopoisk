<?php

use App\Router\Route;

return [
    Route::get('/', function () {
        include_once MAIN_PATH.'/view/pages/index.php';
    }),
    Route::get('/home', function () {
        include_once MAIN_PATH.'/view/pages/home.php';
    }),
    Route::get('/movies', function () {
        include_once MAIN_PATH.'/view/pages/movies.php';
    }),


];
