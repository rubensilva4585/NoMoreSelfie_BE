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

Route::prefix('clients')->group(function () {
    Route::get('', [ClientController::class, 'index']);
    Route::get('{client}', [ClientController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [ClientController::class, 'store']);
        Route::put('{client}', [ClientController::class, 'update']);
        Route::patch('{client}', [ClientController::class, 'update']);
        Route::delete('{client}', [ClientController::class, 'destroy']);
    //});
});

Route::prefix('requests')->group(function () {
    Route::get('', [RequestController::class, 'index']);
    Route::get('{request}', [RequestController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [RequestController::class, 'store']);
        Route::put('{request}', [RequestController::class, 'update']);
        Route::patch('{request}', [RequestController::class, 'update']);
        Route::delete('{request}', [RequestController::class, 'destroy']);
   //});
});

Route::prefix('categories')->group(function () {
    Route::get('', [CategoryController::class, 'index']);
    Route::get('{category}', [CategoryController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [CategoryController::class, 'store']);
        Route::put('{category}', [CategoryController::class, 'update']);
        Route::patch('{category}', [CategoryController::class, 'update']);
        Route::delete('{category}', [CategoryController::class, 'destroy']);
    //});
});

Route::prefix('subcategories')->group(function () {
    Route::get('', [SubCategoryController::class, 'index']);
    Route::get('{subcategory}', [SubCategoryController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [SubCategoryController::class, 'store']);
        Route::put('{subcategory}', [SubCategoryController::class, 'update']);
        Route::patch('{subcategory}', [SubCategoryController::class, 'update']);
        Route::delete('{subcategory}', [SubCategoryController::class, 'destroy']);
    //});
});

Route::prefix('districts')->group(function () {
    Route::get('', [DistrictController::class, 'index']);
    Route::get('{district}', [DistrictController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [DistrictController::class, 'store']);
        Route::put('{district}', [DistrictController::class, 'update']);
        Route::patch('{district}', [DistrictController::class, 'update']);
        Route::delete('{district}', [DistrictController::class, 'destroy']);
    //});
});

Route::prefix('suppliers')->group(function () {
    Route::get('', [SupplierController::class, 'index']);
    Route::get('{supplier}', [SupplierController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [SupplierController::class, 'store']);
        Route::put('{supplier}', [SupplierController::class, 'update']);
        Route::patch('{supplier}', [SupplierController::class, 'update']);
        Route::delete('{supplier}', [SupplierController::class, 'destroy']);
    //});
});

Route::prefix('suppliercategorysubcategories')->group(function () {
    Route::get('', [SupplierCategorySubCategoryController::class, 'index']);
    Route::get('{suppliercategorysubcategory}', [SupplierCategorySubCategoryController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('{suppliercategorysubcategory}', [SupplierCategorySubCategoryController::class, 'store']);
        Route::put('{suppliercategorysubcategory}', [SupplierCategorySubCategoryController::class, 'update']);
        Route::patch('{suppliercategorysubcategory}', [SupplierCategorySubCategoryController::class, 'update']);
        Route::delete('{suppliercategorysubcategory}', [SupplierCategorySubCategoryController::class, 'destroy']);
    //});
});

Route::prefix('socials')->group(function () {
    Route::get('', [SocialController::class, 'index']);
    Route::get('{social}', [SocialController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [SocialController::class, 'store']);
        Route::put('{social}', [SocialController::class, 'update']);
        Route::patch('{social}', [SocialController::class, 'update']);
        Route::delete('{social}', [SocialController::class, 'destroy']);
    //});
});
