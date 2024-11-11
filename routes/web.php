<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard');

// Route::get('/login', function () {
//     return view('admin.authentication.login');
// });
// Route::get('/register', function () {
//     return view(view: 'admin.authentication.register');
// });


// Athentication

Route::get('/create', [AuthController::class, 'index'])->name('register.create');
Route::post('/register', [AuthController::class, 'registration'])->name('registration');
Route::get('/login', [AuthController::class, 'create'])->name('login.create');
Route::post('/create/store', [AuthController::class, 'login'])->name('login');
Route::get('/forget', [AuthController::class, 'forgot'])->name('forgot');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

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


