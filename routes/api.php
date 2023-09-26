<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\RequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;

use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UserSubCategoryController;
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

Route::prefix('profiles')->group(function () {
    Route::get('', [ProfileController::class, 'index']);
    Route::get('{profile}', [ProfileController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [ProfileController::class, 'store']);
        Route::put('{profile}', [ProfileController::class, 'update']);
        Route::patch('{profile}', [ProfileController::class, 'update']);
        Route::delete('{profile}', [ProfileController::class, 'destroy']);
    //});
});

Route::prefix('usersubcategories')->group(function () {
    Route::get('', [UserSubCategoryController::class, 'index']);
    Route::get('{usersubcategory}', [UserSubCategoryController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [UserSubCategoryController::class, 'store']);
        Route::put('{usersubcategory}', [UserSubCategoryController::class, 'update']);
        Route::patch('{usersubcategory}', [UserSubCategoryController::class, 'update']);
        Route::delete('{usersubcategory}', [UserSubCategoryController::class, 'destroy']);
    //});
});