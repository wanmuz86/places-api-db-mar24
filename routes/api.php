<?php

use App\Http\Controllers\PassportAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\FacilityController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/hello', function (Request $request) {
    return response()->json(["data" => "Hello API"]);   /// {"data":"Hello World"}

});

// $name (creating a new variable)

Route::get('/goodbye/{name}', function (Request $request, $name) {
    return response()->json(["data" => "Hello " . $name]);
});
;

Route::post('/info', function (Request $request) {
    return response()->json(["data" => "Hello " . $request["name"] . " You are " . $request["age"] . " years old"]);
});








Route::post('/facilities', [FacilityController::class, 'store']);
Route::get('/facilities', [FacilityController::class, 'index']);

Route::post('/register', [PassportAuthController::class, 'register']);
Route::post('/login', [PassportAuthController::class, 'login']);

Route::middleware('jwt.auth')->group(function () {

    // Semua yang berada di dalam ini kalau nak panggil kena log in

    Route::middleware('jwt.auth')->group(function () {

        Route::get('/test', function () {
            return response()->json(["message" => "All OK"]);
        });

        // 
        Route::post('/hotels', [HotelController::class, 'store']);

        Route::get('/hotels', [HotelController::class, 'index']);

        Route::get('/hotels/{id}', [HotelController::class, 'show']);

        Route::put('/hotels/{id}', [HotelController::class, 'update']);

        Route::delete('/hotels/{id}', [HotelController::class, 'delete']);
        Route::post('/hotels/{hotelId}/reviews', [ReviewController::class, 'store']);

    });

});