<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\UserSubCategoryController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\GeneralController;

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

// ROTAS USADAS NO FRONT
Route::controller(AuthController::class)->group(function () {
    Route::post('auth/login', 'login');
    Route::post('auth/register', 'register');
    Route::post('auth/logout', 'logout');
});

Route::controller(GeneralController::class)->group(function () {
    Route::get('general/districts/getalldistricts', 'getAllDistricts');
    Route::get('general/categories/getcategory/{category}', 'getCategory');
    Route::get('general/categories/getallcategories', 'getAllCategories');
});












// ROTAS TESTE CRUD
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::get('', [UserController::class, 'index']);
    Route::get('{user}', [UserController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [UserController::class, 'store']);
        Route::put('{user}', [UserController::class, 'update']);
        Route::patch('{user}', [UserController::class, 'update']);
        Route::delete('{user}', [UserController::class, 'destroy']);
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

Route::prefix('usersubcategories')->group(function () {
    Route::get('', [UserSubCategoryController::class, 'index']);
    Route::get('{user_id}/{subcategory_id}', [UserSubCategoryController::class, 'show']);

    //Route::middleware('auth:sanctum')->group(function () {
        Route::post('', [UserSubCategoryController::class, 'store']);
        Route::put('{user_id}/{subcategory_id}', [UserSubCategoryController::class, 'update']);
        Route::patch('{user_id}/{subcategory_id}', [UserSubCategoryController::class, 'update']);
        Route::delete('{user_id}/{subcategory_id}', [UserSubCategoryController::class, 'destroy']);
    //});
});
