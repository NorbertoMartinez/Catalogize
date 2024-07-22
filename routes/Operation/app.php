<?php


use App\Http\Controllers\Resources\BrochureController;
use App\Http\Controllers\Resources\BrochureSerieController;
use App\Http\Controllers\Resources\BrochureSerieBrochureController;
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

Route::prefix("/op")->middleware('auth')->group(function () {


    Route::resource("/b2b-bussiness-types",
        B2bBussinessTypeController::class);

    Route::get("/b2b-bussiness-types-detail/{b2b_id?}",
        [B2bBussinessTypeController::class, "resource_detail"]);

    /**
     * CatalogController
     */

    Route::resource("/catalogs",
        CatalogController::class);

    Route::post("/catalog-background/{catalog_id}",
        [CatalogController::class, "upload_background"]);

    Route::post("/catalog-cloner/{catalog_id}",
        [CatalogController::class, "clone"]);

    Route::post("/catalog-publisher/{catalog_id}",
        [CatalogController::class, "publish"]);

    Route::get("/catalog/{catalog_id}",
        [CatalogController::class, "resource_detail"]);

    Route::get("/catalogs-resource",
        [CatalogController::class, "resource"]);


    Route::get("/catalog-sections/{catalog_id?}",
        [CatalogSectionController::class, "resource_detail"]);

    /***
     * SectionController
     */
    Route::resource("/sections",
        SectionController::class);

    Route::post("/section-background/{section_id}",
        [SectionController::class, "upload_background"]);


    Route::get("/section/{section_id?}",
        [SectionController::class, "resource_detail"]);


    Route::post("/sections-product",
        [SectionProductController::class, "store"]);

    Route::post("/section-products/{section_id?}",
        [SectionProductController::class, "mass_store"]);


    Route::post("/section-publisher/{catalog_id}",
        [SectionController::class, "publish"]);


    /**
     * ProductController
     */
    Route::resource("/products",
        ProductController::class);

    Route::post("/product-image/{product_id}",
        [ProductController::class, "store_picture"]);

    Route::get("/product-parent-resource/{product_id}",
        [ProductController::class, "parent_resource_detail"]);

    Route::get("/b2b-products/{b2b_id}",
        [ProductController::class, "resource_detail_by_b2b"]);

    Route::get("/catalog-products/{b2b_id}/{catalog_id?}",
        [ProductController::class, "resource_detail_by_catalog"]);

    Route::post("/product-publisher/{product_id}",
        [ProductController::class, "publish"]);

    Route::resource("/product-features",
        ProductFeatureController::class);

    Route::get("/product-feature/{product_id}",
        [ProductFeatureController::class, "resource_detail"]);

    Route::resource("/product-links",
        ProductLinkController::class);

    Route::get("/product-link/{product_id}",
        [ProductLinkController::class, "resource_detail"]);

    Route::resource("/product-gallery",
        ProductGalleryController::class);

    Route::resource("/product-gallery-item",
        ProductGalleryItemController::class);

    Route::get("/product-galleries/{product_id?}",
        [ProductGalleryController::class, "resource_detail"]);

    Route::get("/product-gallery-items/{catalog_id?}",
        [ProductGalleryItemController::class, "resource_detail"]);



    /**
     * Brochures
     */

    Route::resource("/brochures",
        BrochureController::class);

    Route::get("/resource/brochure/{brochure_id}",
        [BrochureController::class, "resource_detail"]);

    Route::get("/resource/brochures",
        [BrochureController::class, "resource"]);

    Route::post("/resource/brochure-pattern/{brochure_id?}",
        [BrochureController::class, "upload_pattern"]);

    Route::post("/resource/brochure-resource/{brochure_id?}",
        [BrochureController::class, "upload_resource"]);

    Route::post("/brochure-publisher/{product_id}",
        [BrochureController::class, "publish"]);

    /**
     * Brochures Serie
     */

    Route::resource("/brochures-series",
        BrochureSerieController::class);

    Route::get("/resource/brochure-serie/{brochure_id}",
        [BrochureSerieController::class, "resource_detail"]);
//
    Route::get("/resource/brochures-series",
        [BrochureSerieController::class, "resource"]);
//
//    Route::post("/resource/brochure-series-item/{brochure_id?}",
//        [BrochureSerieController::class, "upload_pattern"]);
//
//    Route::post("/resource/brochure-resource/{brochure_id?}",
//        [BrochureSerieController::class, "upload_resource"]);
//
    Route::post("/brochure-series-publisher/{product_id}",
        [BrochureSerieController::class, "publish"]);


    /**
     * Brochures Serie
     */

    Route::resource("/brochures-series-item",
        BrochureSerieBrochureController::class);
});
