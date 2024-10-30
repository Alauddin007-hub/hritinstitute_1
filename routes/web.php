<?php

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


Route::get('/categories', function () {
    return view('admin.category.index');
});
Route::get('/category/create', function () {
    return view('admin.category.create');
})->name('category.create');
Route::get('/category/store', function () {
    return view('admin.category.create');
})->name('category.store');
