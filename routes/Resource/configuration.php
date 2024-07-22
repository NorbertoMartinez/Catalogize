<?php

use \App\Http\Controllers\Resources\B2bController;
use Inertia\Inertia;

Route::prefix("config")->middleware('auth')->group(function () {



    Route::get('/account', function () {
        return Inertia::render('Configuration/Index',
            []);
    })->name("config.account");

});
