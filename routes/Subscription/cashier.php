<?php

use App\Http\Controllers\Transactions\PlanController;
use Illuminate\Http\Request;

Route::get('/billing-portal', function (Request $request) {
    return $request->user()->redirectToBillingPortal(route("dashboard"));
})->name("billing");


Route::post('/user/subscribe', function (Request $request) {
    $request->user()->newSubscription(
        'prod_NjW579tXC6k4gu', 'price_1My33MHKxMb8HPmwViW5ZtdQ'
    )->create($request->paymentMethodId);

    // ...
});


Route::post('/user/subscribe', function (Request $request) {
    $request->user()->newSubscription(
        'prod_NjW579tXC6k4gu', 'price_1My33MHKxMb8HPmwViW5ZtdQ'
    )->create($request->paymentMethodId);

    // ...
});

Route::get('/plans', [PlanController::class, "index"])
    ->middleware(['auth', 'verified'])->name('plans');
