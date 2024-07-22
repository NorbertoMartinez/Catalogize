<?php

use \App\Http\Controllers\Resources\B2bController;
use App\Http\Controllers\UserController;
use Inertia\Inertia;

Route::prefix("u")->middleware('auth')->group(function () {


    Route::post("/account-picture/{b2b_id}",
        [UserController::class, "store_picture"]);

});
