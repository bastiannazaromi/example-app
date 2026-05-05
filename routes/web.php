<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/halo', function () {
    return 'Halo, selamat datang di perkuliahan Web 2!';
});

Route::get('/user/{nama}', function ($nama) {
    return 'Halo, ' . $nama;
});

Route::get('/sapa', [CategoryController::class, 'index']);
Route::get('/sapa/{nama}', [CategoryController::class, 'sapa']);

// Category
Route::get('/category', [CategoryController::class, 'index']);
Route::get('/category/create', [CategoryController::class, 'create']);
Route::post('/category', [CategoryController::class, 'store']);
Route::delete('/category/{id}', [CategoryController::class, 'destroy']);
