<?php

use App\Http\Controllers\Api\V2\StudentApiController as StudentApiControllerV2;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\StudentApiController;
use Illuminate\Support\Facades\Auth;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::get('/hello', function () {
    return response()->json([
        'message' => 'Hello Ali',
        'status' => true
    ]);


});

Route::post('/test', function () {
    return response()->json([
        'message' => 'POST API Working'
    ]);
});
Route::middleware('web')->get('/profile-test', function (Request $request) {

    return response()->json([
        'authenticated' => Auth::check(),
        'user' => Auth::user(),
    ]);

});

Route::prefix('v1')->name('api.v1.')->group(function () {

    Route::post('/login', [AuthController::class, 'login']);
    Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('students', StudentApiController::class);
        Route::post('/logout', [AuthController::class, 'logout']);
    });

});
Route::prefix('v2') ->name('api.v2.')->group(function () {
     Route::middleware('auth:sanctum')->group(function () {

        Route::apiResource('students', StudentApiControllerV2::class);
        Route::get('/profile', function (Request $request) {
            return $request->user();
        });

        Route::post('/logout', [AuthController::class, 'logout']);

    });


});



