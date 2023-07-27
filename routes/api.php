<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\GeneralController;
use App\Http\Controllers\Api\BusinessRequestController;

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

##Category
Route::get('/get-category', [GeneralController::class,'getCategory']);

##subcategory
Route::get('/get-sub-category', [GeneralController::class,'getSubCategory']);

##Degree
Route::get('/get-degree', [GeneralController::class,'getDegree']);

##products
Route::get('/get-product', [GeneralController::class,'getProducts']);

##subcategory
Route::get('/get-sub-degree', [GeneralController::class,'getSubDegree']);

## Request list
Route::get('/get-request', [BusinessRequestController::class,'getRequest']);
##Request deatil
Route::get('/get-request-detail/{id?}', [BusinessRequestController::class,'getRequestDetail']);
## get terms
Route::get('/get-terms', [GeneralController::class,'getTerms']);
Route::get('/get-services', [GeneralController::class,'getService']);

Route::group(['middleware' => ['auth-token']], function () {
    ## update registration detail
    Route::post('/add-registration-detail', [AuthController::class,'addRegistrationDetail']);
    ## add new request  (for company House business..)
    Route::post('/add-new-request', [BusinessRequestController::class,'addRequest']);
    
});