<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Email Preview Routes (for development only)
Route::get('/preview/domain-created', function () {
    $domain = App\Models\Domain::first();
    return new App\Mail\DomainCreatedMail($domain);
});

Route::get('/preview/domain-expiry/{days?}', function ($days = 7) {
    $domain = App\Models\Domain::first();
    return new App\Mail\DomainExpiryMail($domain, (int) $days);
});

Route::get('/preview/payment-added', function () {
    $payment = App\Models\Payment::with('domain')->first();
    return new App\Mail\PaymentAddedMail($payment);
});

// Fallback route to serve storage files with CORS headers when the physical symlink is removed
Route::any('public_storage/{path}', function ($path) {
    $filePath = storage_path("app/public/{$path}");

    if (!file_exists($filePath)) {
        abort(404);
    }

    $headers = [
        'Access-Control-Allow-Origin' => '*',
        'Access-Control-Allow-Methods' => '*',
        'Access-Control-Allow-Headers' => '*',
    ];

    if (request()->isMethod('OPTIONS')) {
        return response('', 200, $headers);
    }

    return response()->file($filePath, $headers);
})->where('path', '.*');
