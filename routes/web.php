<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});

Route::get('/login', function () {
    return view('admin.authentication.login');
});

Route::get('/categories', [CategoryController::class, 'index'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.crate');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');


// Route::get('/categories', function () {
//     return view('admin.category.index');
// });
Route::get('/category/create', function () {
    return view('admin.category.create');
})->name('category.create');
Route::get('/category/store', function () {
    return view('admin.category.create');
})->name('category.store');
