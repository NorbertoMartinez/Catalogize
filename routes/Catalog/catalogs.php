<?php

use App\Http\Controllers\Catalogs\ARPatternController;
use App\Http\Controllers\Catalogs\AvailabilityController;
use App\Http\Controllers\Catalogs\BussinessTypeController;
use App\Http\Controllers\Catalogs\BussinessTypeCatalogTypeController;
use App\Http\Controllers\Catalogs\CartStatusController;
use App\Http\Controllers\Catalogs\CatalogTypeController;
use App\Http\Controllers\Catalogs\CatalogTypeProductTypeController;
use App\Http\Controllers\Catalogs\FeatureController;
use App\Http\Controllers\Catalogs\LinkTypeController;
use App\Http\Controllers\Catalogs\NotificationStatusController;
use App\Http\Controllers\Catalogs\OrderStatusController;
use App\Http\Controllers\Catalogs\PaymentStatusController;
use App\Http\Controllers\Catalogs\ProductTypeController;
use App\Http\Controllers\Catalogs\ProductTypeFeatureController;
use App\Http\Controllers\Catalogs\ProductTypeUnitController;
use App\Http\Controllers\Catalogs\SpecificationTypeController;
use App\Http\Controllers\Catalogs\StatusController;
use App\Http\Controllers\Catalogs\SubscriptionStatusController;
use App\Http\Controllers\Catalogs\UnitController;
use App\Http\Controllers\Catalogs\ViewerStatusController;
use App\Http\Controllers\Catalogs\BrochureTypeController;


Route::prefix("resources")
    ->group(function(){

    Route::get("/availabilities",
        [AvailabilityController::class, "resource"]);

    Route::get("/bussiness-types",
        [BussinessTypeController::class, "resource"]);

    Route::get("/brochures-types",
        [BrochureTypeController::class, "resource"]);

    Route::get("/catalog-types",
        [CatalogTypeController::class, "resource"]);

//    Route::get("/catalog-type-product-types",
//      [CatalogTypeProductTypeController::class, "resource"])->name('catalogTypesProductTypes');

    Route::get("/features",
        [FeatureController::class, "resource"]);

    Route::get("/link-types",
        [LinkTypeController::class, "resource"]);

    Route::get("/product-types",
        [ProductTypeController::class, "resource"]);

//    Route::get("/product-type-features",
//      [ProductTypeFeatureController::class, "resource"])->name('productTypeFeatures');

    Route::get("/specification-types",
        [SpecificationTypeController::class, "resource"]);

    Route::get("/statuses",
        [StatusController::class, "resource"]);

    Route::get("/units",
        [UnitController::class, "resource"]);

    Route::get("/patterns",
        [ARPatternController::class, "resource"]);




    Route::get("/pattern/{pattern_id?}",
        [ARPatternController::class, "resource_detail"]);

    Route::get("/availability/{id?}",
        [AvailabilityController::class, "resource_detail"]);

    Route::get("/bussiness-type/{id?}",
        [BussinessTypeController::class, "resource_detail"]);

    Route::get("/bussiness-type-catalogs-types/{bussines_type_id?}",
        [BussinessTypeCatalogTypeController::class, "resource_detail"]);

    Route::get("/catalog-type/{id?}",
        [CatalogTypeController::class, "resource_detail"]);

    Route::get("/catalog-type-product-type/{catalog_type_id?}",
        [CatalogTypeProductTypeController::class, "resource_detail"]);

    Route::get("/feature/{id?}",
        [FeatureController::class, "resource_detail"]);

    Route::get("/link-types",
        [LinkTypeController::class, "resource"]);

    Route::get("/link-type/{id?}",
        [LinkTypeController::class, "resource_detail"]);

    Route::get("/product-type/{id?}",
        [ProductTypeController::class, "resource_detail"]);

    Route::get("/product-type-features/{product_type_id?}",
        [ProductTypeFeatureController::class, "resource_detail"]);

    Route::get("/product-type-units/{product_type_id?}",
        [ProductTypeUnitController::class, "resource_detail"]);

    Route::get("/specification-type/{id?}",
        [SpecificationTypeController::class, "resource_detail"]);

    Route::get("/status/{id?}",
        [StatusController::class, "resource_detail"]);

    Route::get("/unit/{id?}",
        [UnitController::class, "resource_detail"]);


});

Route::prefix("/cats")->middleware('auth')->group(function () {

    Route::resource("/availabilities",
        AvailabilityController::class);

    Route::resource("/bussiness-types",
        BussinessTypeController::class);

    Route::resource("/catalog-types",
        CatalogTypeController::class);

    Route::resource("/catalog-type-product-types",
        CatalogTypeProductTypeController::class);

    Route::resource("/features",
        FeatureController::class);

    Route::resource("/link-types",
        LinkTypeController::class);

    Route::resource("/product-types",
        ProductTypeController::class);

    Route::resource("/product-type-features",
        ProductTypeFeatureController::class);

    Route::resource("/specification-types",
        SpecificationTypeController::class);

    Route::resource("/statuses",
        StatusController::class);

    Route::resource("/units",
        UnitController::class);



    Route::resource("/cart-statuses", CartStatusController::class);
    Route::resource("/notification-statuses", NotificationStatusController::class);
    Route::resource("/order-statuses", OrderStatusController::class);
    Route::resource("/payment-statuses", PaymentStatusController::class);
    Route::resource("/subscription-statuses", SubscriptionStatusController::class);
    Route::resource("/viewer-statuses", ViewerStatusController::class);


});
