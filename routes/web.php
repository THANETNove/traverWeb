<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;


Route::get('/', function () {

       // if (Auth::check()) {
       // ชถ้าผู้ใช้ล็อกอิน ให้ตรวจสอบว่า `name` มีอยู่หรือไม่
    /* if (Auth::user()->name && Auth::user()->status == "1") {
            return redirect('home');
        }
    } else {
        return view('welcome');
    } */

    return view('welcome');
});

Auth::routes();



Route::middleware(['isAdmin'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/trave-create', [HomeController::class, 'create'])->name('trave-create');
    Route::post('/trave-store', [HomeController::class, 'store'])->name('trave-store');
    Route::get('/trave-edit/{id}', [HomeController::class, 'edit'])->name('trave-edit');
    Route::put('/trave-update/{id}', [HomeController::class, 'update'])->name('trave-update');
    Route::get('/trave-destroy/{id}', [HomeController::class, 'destroy'])->name('trave-destroy');
    Route::post('/trave-search', [HomeController::class, 'search'])->name('trave-search');
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category-create', [CategoryController::class, 'create'])->name('category-create');
    Route::post('/category-store', [CategoryController::class, 'store'])->name('category-store');
    Route::get('/category-destroy/{id}', [CategoryController::class, 'destroy'])->name('category-destroy');
    Route::post('/category-search', [CategoryController::class, 'search'])->name('category-search');
});
