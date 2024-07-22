<?php

use \App\Http\Controllers\Resources\B2bController;
use Inertia\Inertia;

Route::prefix("admin")->middleware('auth')->group(function () {


    Route::get('/subscripctions', function () {
        return Inertia::render('Subscriptions/Index',
            []);
    })->name("admin.subscription");

    Route::get('/orders', function () {
        return Inertia::render('Orders/Index',
            []);
    })->name("admin.orders");

});
