<?php

use App\Controllers\HomeController;
use App\Controllers\IndexController;
use App\Controllers\MovieController;
use App\Kernel\Router\Route;
use App\Controllers\RegisterController;
use App\Controllers\LoginController;

return [

    Route::get('/', [IndexController::class,'index']),
    Route::get('/movies',[MovieController::class,'index']),

    // добавление фильма
    Route::get('/admin/movie/add', [MovieController::class,'addFormView']),
    Route::post('/admin/movie/add', [MovieController::class,'addMovie']),

    //регистрация
    Route::get("/register", [RegisterController::class, 'index']),
    Route::post("/register", [RegisterController::class, 'register']),

    //авторизация
    Route::get("/login", [LoginController::class, 'index']),
    Route::post("/login", [LoginController::class, 'login']),
    Route::post("/logout", [LoginController::class, 'logout']),




    /*Route::get('/home',function () {
        include_once MAIN_PATH.'/view/pages/home.php';
    }),  -- c момента авторизации идет проверка массива  -- */

];
