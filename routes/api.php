<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Trippledee\ContactForm\Http\Controllers\API\ContactController;

Route::group(['prefix' => 'api/contact', 'middleware' => ['api']], function () {
    Route::middleware(['auth:api'])->group(function () {
        Route::get('/my-submissions', [ContactController::class, 'index']);
    });
});

// Test Route to get JWT Token for Admin
Route::post('/api/test-token', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (! $token = auth('api')->attempt($credentials)) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    return response()->json([
        'access_token' => $token,
        'token_type' => 'bearer',
        'expires_in' => auth('api')->factory()->getTTL() * 60
    ]);
})->middleware('api');
