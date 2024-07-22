<?php

use App\Http\Controllers\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/constrained', function () {
    return Inertia::render('Administration/Index');
})->middleware(['auth', 'verified'])->name('constrained');

Route::get('/catalog', function () {
    return Inertia::render('Catalogs/Create');
})->middleware(['auth', 'verified'])->name('catalog');

Route::get('/catalog/{id?}', function () {
    return Inertia::render('Catalogs/Edit');
})->middleware(['auth', 'verified'])->name('catalog');

Route::get('/catalogs', function () {
    return Inertia::render('Catalogs/Index');
})->middleware(['auth', 'verified'])->name('catalogs');


Route::get('/product', function () {
    return Inertia::render('Products/Create');
})->middleware(['auth', 'verified'])->name('product');

Route::get('/products', function () {
    return Inertia::render('Products/Index');
})->middleware(['auth', 'verified'])->name('products');



Route::get('/section', function () {
    return Inertia::render('Sections/Create');
})->middleware(['auth', 'verified'])->name('section');

Route::get('/sections', function () {
    return Inertia::render('Sections/Index');
})->middleware(['auth', 'verified'])->name('sections');


Route::get('/account', [UserController::class, "index"])
    ->middleware(['auth', 'verified'])->name('account');

