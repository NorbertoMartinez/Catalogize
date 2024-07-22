<?php

use \App\Http\Controllers\Resources\B2bController;
use Inertia\Inertia;

Route::prefix("x")->middleware('auth')->group(function () {

    Route::resource("/b2bs",
        B2bController::class);

    Route::post("/b2b-logo/{b2b_id}",
        [B2bController::class, "store_picture"]);

    Route::get("/b2b-list",
        [B2bController::class, "resource"]);

    Route::get("/b2bs/resource/{id?}",
        [B2bController::class, "resource_detail"]);

    Route::post("/b2b-publisher/{b2b_id}",
        [B2bController::class, "publish"]);

    Route::get("/b2b-users",
        [B2bController::class, "resource_user"]);



    Route::get('/clients', function () {
        return Inertia::render('Customers/Index',
            []);
    })->name("x.customers");

    Route::get('/message-center', function () {
        return Inertia::render('MessageCenter/Index',
            []);
    })->name("x.center");

    Route::get('/marketing', function () {
        return Inertia::render('Marketing/Index',
            []);
    })->name("x.marketing");
});
