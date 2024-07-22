<?php


use App\Http\Controllers\Operation\VisitorController;
use App\Http\Controllers\Resources\CatalogController;
use App\Http\Controllers\Resources\ProductController;
use App\Http\Controllers\Resources\SectionController;
use App\Http\Controllers\Resources\B2bBussinessTypeController;
use \App\Http\Controllers\Operation\ViewBuilderController;

Route::prefix("/viewer")->group(function () {


    Route::get("/preview/{hash?}",
        [ViewBuilderController::class, "preview"]);



    Route::get("/scene/{hash?}",
        [ViewBuilderController::class, "sceneBuilder"]);



    Route::resource("/visitor",
        VisitorController::class);

    Route::get("/visitors",
        [VisitorController::class, "resource"]);



});
