<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DistrictController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\DegreeController; 
use App\Http\Controllers\Backend\SubDegreeController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProductController;

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

    ##category
    Route::resource('category',CategoryController::class);
    
    ##subcategory 
    Route::resource('subcategory',SubCategoryController::class);

    ##Degree
    Route::resource('degree',DegreeController::class);
    
    ##subDegree 
    Route::resource('subdegree',SubDegreeController::class);
    
    ##Products 
    Route::resource('product',ProductController::class);
    
    ##Customer List 
    Route::group(['prefix' => 'customer','as' => 'customer.'], function () {
        Route::get('/',[UserController::class,'index']);
        Route::get('detail/{id?}',[UserController::class,'detail'])->name('detail');
    });
});
