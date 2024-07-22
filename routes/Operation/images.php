<?php


use App\Http\Controllers\Resources\BrochureController;
use App\Http\Controllers\Resources\CatalogController;
use App\Http\Controllers\Resources\ProductController;
use App\Http\Controllers\Resources\SectionController;
use App\Http\Controllers\Resources\B2bBussinessTypeController;
use App\Http\Controllers\Resources\SectionProductController;
use App\Http\Controllers\Resources\CatalogSectionController;

use App\Http\Controllers\Resources\ProductFeatureController;
use App\Http\Controllers\Resources\ProductGalleryController;
use App\Http\Controllers\Resources\ProductGalleryItemController;
use App\Http\Controllers\Resources\ProductLinkController;

Route::prefix("/op")->group(function () {

    Route::get('ar_resources/{filename}', function ($filename)
    {
        $path = storage_path('app/public/ar_resources/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        return $response;
    });
    Route::get('gallery/{filename}', function ($filename)
    {
        $path = storage_path('app/public/gallery/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        return $response;
    });

    Route::get('patterns/{filename}', function ($filename)
    {
        $path = storage_path('app/public/patterns/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        return $response;
    });

    Route::get('storage/{filename}', function ($filename)
    {
        $path = storage_path('app/public/uploads/' . $filename);

//        dump($path);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        return $response;
    });

    Route::get('images/{filename}', function ($filename)
    {
        $path = storage_path('app/public/images/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        return $response;
    });

    Route::get('background/{filename}', function ($filename)
    {
        $path = storage_path('app/public/backgrounds/' . $filename);

//        dump($path);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        return $response;
    });

});
