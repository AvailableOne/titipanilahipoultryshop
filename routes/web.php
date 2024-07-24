<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Controller::class, 'index']);
Route::get('/produk', [Controller::class, 'produk']);
Route::get('/produk/{slug}', [Controller::class, 'detail']);

Route::get('/masuk', [Controller::class, 'masuk'])->middleware('guest')->name('masuk');
Route::post('/masuk', [Controller::class, 'authenticate']);
Route::post('/keluar', [Controller::class, 'keluar']);

Route::get('/daftar', [Controller::class, 'daftar'])->middleware('guest');
Route::post('/daftar', [Controller::class, 'store']);

Route::middleware(['auth', 'role:user', 'auth.redirect'])->group(function () {
    Route::get('/tambah/{id}', [ProductController::class, 'addProducttoCart'])->name('addproduct.to.cart');
    Route::get('/keranjang', [ProductController::class, 'bookCart'])->name('shopping.cart');
    Route::get('/keranjang/tambah/{id}', [ProductController::class, 'increaseQuantity'])->name('increase.quantity');
    Route::get('/keranjang/kurang/{id}', [ProductController::class, 'decreaseQuantity'])->name('decrease.quantity');
    Route::delete('/keranjang/hapus/{id}', 'App\Http\Controllers\ProductController@deleteProduct')->name('delete.cart.product');


    // Route::post('/keranjang/add/{productId}', [CartController::class, 'add'])->name('cart.add');
    // Route::post('/keranjang/add/{productId}', [CartController::class, 'store'])->name('cart.store');
    // Route::get('/keranjang', [CartController::class, 'read'])->name('cart.read');
    // Route::post('/keranjang/update/{productId}', [CartController::class, 'update'])->name('cart.update');
    // Route::post('/keranjang/delete/{productId}', [CartController::class, 'delete'])->name('cart.delete');

});

Route::middleware(['auth', 'role:admin', 'auth.redirect'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('pages.admin.index');

    Route::post('/admin/katalog', [CatalogController::class, 'store'])->name('catalog.store');
    Route::get('/admin/katalog', [CatalogController::class, 'read']);
    Route::post('/admin/katalog/update', [CatalogController::class, 'update'])->name('catalog.update');
    Route::post('/admin/katalog/delete', [CatalogController::class, 'delete'])->name('catalog.delete');
    Route::get('/admin/katalog/{catalog}/produk', [CatalogController::class, 'showProducts'])->name('admin.pages.catalog.products');

    Route::post('/admin/kategori', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/admin/kategori', [CategoryController::class, 'read']);
    Route::post('/admin/kategori/update', [CategoryController::class, 'update'])->name('category.update');
    Route::post('/admin/kategori/delete', [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/admin/kategori/{catalog}/produk', [CategoryController::class, 'showProducts'])->name('admin.pages.category.products');

    Route::post('/admin/produk', [ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/produk', [ProductController::class, 'read']);
    Route::post('/admin/produk/update', [ProductController::class, 'update'])->name('product.update');
    Route::post('/admin/produk/delete', [ProductController::class, 'delete'])->name('product.delete');
});
