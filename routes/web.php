<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

// Category Routes

Route::get('/categories', [CategoryController::class, 'index'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
Route::get('/category/{id}', [CategoryController::class, 'destroy'])->name('category.delete');


// Products Routes

Route::get('/products', [ProductController::class, 'index'])->name('product');
Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
Route::post('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product/{id}', [ProductController::class, 'destroy'])->name('product.delete');



// Route::get('/categories', function () {
//     return view('admin.category.index');
// });
// Route::get('/category/create', function () {
//     return view('admin.category.create');
// })->name('category.create');
// Route::get('/category/store', function () {
//     return view('admin.category.create');
// })->name('category.store');
