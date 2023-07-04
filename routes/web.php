<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    ##district
    Route::resource('district',DistrictController::class);
    
    ##city
    Route::resource('city',CityController::class);
    
    ##Role
    Route::resource('role',RoleController::class);
    
});
