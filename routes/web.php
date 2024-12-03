<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');



// Athentication

Route::get('/create', [AuthController::class, 'index'])->name('register.create');
Route::post('/register', [AuthController::class, 'registration'])->name('registration');
Route::get('/', [AuthController::class, 'create'])->name('login.create');
Route::post('/create/store', [AuthController::class, 'login'])->name('login');
Route::get('/forget', [AuthController::class, 'forgot'])->name('forgot');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// Multi user
// Route::group(['middleware' => 'Admin'], function () {
//     Route::get('/categories', [CategoryController::class, 'index'])->name('category');
//     Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
//     Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
// });

// Category Routes

Route::get('/categories', [CategoryController::class, 'index'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');


// Products Routes

Route::get('/product', [ProductController::class, 'index'])->name('product.index');

Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');

Route::middleware(['Admin'])->group(function () {

});


// Frontend

// Home Page

Route::get('/home', function() {
    return view('frontend.home.product');
})->name('home');