<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GeneralController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

##Login
Route::post('/login', [AuthController::class,'login']);

## Verify Otp
Route::post('/verify-otp', [AuthController::class,'verifyOtp']);

##District
Route::get('/get-district', [GeneralController::class,'getDistrict']);

##City
Route::get('/get-city', [GeneralController::class,'getCity']);


Route::group(['middleware' => ['auth-token']], function () {
    Route::post('/add-registration-detail', [AuthController::class,'addRegistrationDetail']);

});