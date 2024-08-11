<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category-create', [CategoryController::class, 'create'])->name('category-create');
Route::post('/category-store', [CategoryController::class, 'store'])->name('category-store');
Route::get('/category-destroy/{id}', [CategoryController::class, 'destroy'])->name('category-destroy');
Route::post('/category-search', [CategoryController::class, 'search'])->name('category-search');
