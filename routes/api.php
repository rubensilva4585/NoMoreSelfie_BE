<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ClientController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SupplierCategorySubCategoryController;
use App\Http\Controllers\SocialController;

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

Route::resource('clients', ClientController::class);
Route::resource('requests', RequestController::class);
Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubCategoryController::class);

Route::resource('districts', DistrictController::class);
Route::resource('suppliers', SupplierController::class);
Route::resource('supplier-category-subcategories', SupplierCategorySubCategoryController::class);
Route::resource('socials', SocialController::class);