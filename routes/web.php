<?php

use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
//use App\Http\Controllers\ProfileController;

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
require __DIR__ . '/Viewer/viewer.php';

require __DIR__ . '/mockup.php';
require __DIR__ . '/Catalog/catalogs.php';

require __DIR__ . '/Operation/images.php';
require __DIR__ . '/Operation/app.php';

require __DIR__ . '/Resource/administration.php';
require __DIR__ . '/Resource/configuration.php';
require __DIR__ . '/Resource/b2b.php';

require __DIR__ . '/Subscription/cashier.php';
require __DIR__ . '/Resource/user.php';


Route::get('/', function () {
    return Inertia::render('FrontEnd', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::middleware('auth')->group(function () {
//    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//});

Route::get('/components/buttons', function () {
    return Inertia::render('Components/Buttons');
})->middleware(['auth', 'verified'])->name('components.buttons');

require __DIR__ . '/auth.php';
